<?php

namespace Controllers;

use Core\Controller;
use Core\Request;
use Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return $this->view('profile');
    }

    public function update(Request $request)
    {
        $credential = $request->validate([
            'nama' => ['required', 'trim', 'str', 'min:2', 'max:50'],
            'email' => ['required', 'email', 'str', 'min:5', 'max:50'],
        ]);

        $email = User::where('email', $request->email)
            ->where('id', auth()->user()->id, '!=')
            ->limit(1)->first();

        if ($email->email) {
            $request->throwError([
                'email' => 'email sudah ada'
            ]);
        }

        if (!empty($request->password) && !empty($request->konfirmasi_password)) {
            $request->validate([
                'password' => ['trim', 'str', 'min:8', 'max:20'],
                'konfirmasi_password' => ['trim', 'str', 'min:8', 'max:20', 'sama:password', 'hash']
            ]);

            $credential['password'] = $request->konfirmasi_password;
        }

        User::where('id', auth()->user()->id)->update($credential);

        return $this->back()->with('berhasil', 'Berhasil mengupdate profil');
    }
}
