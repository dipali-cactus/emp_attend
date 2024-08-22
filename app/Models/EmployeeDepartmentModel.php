<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeDepartmentModel extends Model
{
    protected $table = 'employee_department';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'employee_id',
        'department_id'
    ];

    protected $useAutoIncrement = true;
}

