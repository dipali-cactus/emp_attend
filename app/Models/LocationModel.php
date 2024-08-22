<?php

namespace App\Models;

use CodeIgniter\Model;

class LocationModel extends Model
{
    protected $table = 'location';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name'];

    protected $useAutoIncrement = true;
}

