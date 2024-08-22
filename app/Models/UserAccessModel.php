<?php

namespace App\Models;

use CodeIgniter\Model;

class UserAccessModel extends Model
{
    protected $table = 'user_access';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'role_id',
        'menu_id'
    ];

    protected $useAutoIncrement = true;
}
