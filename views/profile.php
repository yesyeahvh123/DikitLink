<?= extend('templates/top', ['title' => 'Profile']) ?>

<h4 class="mb-3">
    <i class="fa-solid fa-address-card"></i>
    Profile
</h4>

<div class="card border-dark mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h5 class="card-title"><i class="fas fa-user"></i> <?= e(auth()->user()->nama) ?></h5>
                <hr>
                <p class="card-text"><i class="fas fa-envelope"></i> <?= e(auth()->user()->email) ?></p>
                <p class="card-text"><i class="fas fa-user-clock"></i> <?= date("d M Y, H:i", strtotime((auth()->user()->created_at))) ?></p>
                <p class="card-text"><i class="fas fa-history"></i> <?= date("d M Y, H:i", strtotime((auth()->user()->updated_at))) ?></p>
                <hr class="mb-0">
            </div>
            <div class="col-md-8">
                <form method="post" class="my-3 mx-1" onsubmit="update()">
                    <?= csrf() ?>
                    <?= method('put') ?>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" placeholder="Nama" class="form-control  <?= error('nama', 'is-invalid') ?>" name="nama" value="<?= e(auth()->user()->nama) ?>">

                        <?php if (error('nama')) : ?>
                            <div class="invalid-feedback">
                                <?= error('nama') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" placeholder="Email" class="form-control <?= error('email', 'is-invalid') ?>" name="email" value="<?= e(auth()->user()->email) ?>">

                        <?php if (error('email')) : ?>
                            <div class="invalid-feedback">
                                <?= error('email') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" placeholder="Password" class="form-control <?= error('password', 'is-invalid') ?>" name="password" autocomplete="off">

                                <?php if (error('password')) : ?>
                                    <div class="invalid-feedback">
                                        <?= error('password') ?>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="col-md-6 ms-auto">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-redo"></i></span>
                                <input type="password" placeholder="Repeat" class="form-control  <?= error('konfirmasi_password', 'is-invalid') ?>" name="konfirmasi_password" autocomplete="off">

                                <?php if (error('konfirmasi_password')) : ?>
                                    <div class="invalid-feedback">
                                        <?= error('konfirmasi_password') ?>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-sm" id="button-update">
                            <i class="fas fa-check"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if ($pesan = flash('berhasil')) : ?>
    <script defer>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: `<?= $pesan ?>`,
                icon: 'success',
                confirmButtonText: '<i class="fas fa-check"></i> Oke',
            });
        });
    </script>
<?php endif ?>

<script>
    const update = () => {
        let btn = document.getElementById('button-update');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
    }
</script>

<?= extend('templates/down') ?>