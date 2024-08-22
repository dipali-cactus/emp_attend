<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'attendance';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username',
        'employee_id',
        'department_id',
        'shift_id',
        'location_id',
        'in_time',
        'notes',
        'image',
        'lack_of',
        'in_status',
        'out_time',
        'out_status'
    ];

    protected $useAutoIncrement = true;
}


