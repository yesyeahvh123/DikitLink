<?php

namespace Models;

use Core\Model;

final class Link extends Model
{
    protected $table = 'links';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
