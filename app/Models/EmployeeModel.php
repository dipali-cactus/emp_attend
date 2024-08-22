<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'email',
        'gender',
        'image',
        'birth_date',
        'hire_date',
        'shift_id'
    ];

    protected $useAutoIncrement = true;
}

