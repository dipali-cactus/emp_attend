<?php

namespace App\Models;

use CodeIgniter\Model;

class UserSubmenuModel extends Model
{
    protected $table = 'user_submenu';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'menu_id',
        'title',
        'url',
        'icon',
        'is_active'
    ];

    protected $useAutoIncrement = true;
}
