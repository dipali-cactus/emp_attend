<?php

namespace App\Models;

use CodeIgniter\Model;

class ShiftModel extends Model
{
    protected $table = 'shift';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'start',
        'end'
    ];

    protected $useAutoIncrement = true;
}

