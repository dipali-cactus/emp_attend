<?php

namespace App\Models;

use CodeIgniter\Model;

class UserMenuModel extends Model
{
    protected $table = 'user_menu';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'menu'
    ];

    protected $useAutoIncrement = true;
}
