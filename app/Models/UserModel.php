<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'username';

    protected $allowedFields = [
        'password',
        'employee_id',
        'role_id'
    ];
}

