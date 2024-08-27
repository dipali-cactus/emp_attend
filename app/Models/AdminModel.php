<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'users';

    public function getAdmin($username)
    {
        $account = $this->where('username', $username)->first();
        $e_id = $account['employee_id'];
        
        $query = $this->db->query("
            SELECT employee.id AS `id`,
                   employee.name AS `name`,
                   employee.gender AS `gender`,
                   employee.shift_id AS `shift`,
                   employee.image AS `image`,
                   employee.birth_date AS `birth_date`,
                   employee.hire_date AS `hire_date`
            FROM employee
            WHERE `employee`.`id` = :e_id:
        ", ['e_id' => $e_id]);
        
        return $query->getRowArray();
    }

    public function getDataForDashboard()
    {
        $db = \Config\Database::connect();

        $d['shift'] = $db->table('shift')->get()->getResultArray();
        $d['c_shift'] = $db->table('shift')->countAllResults();
        $d['location'] = $db->table('location')->get()->getResultArray();
        $d['c_location'] = $db->table('location')->countAllResults();
        $d['employee'] = $db->table('employee')->get()->getResultArray();
        $d['c_employee'] = $db->table('employee')->countAllResults();
        $d['department'] = $db->table('department')->get()->getResultArray();
        $d['c_department'] = $db->table('department')->countAllResults();
        $d['users'] = $db->table('users')->get()->getResultArray();
        $d['c_users'] = $db->table('users')->countAllResults();

        return $d;
    }

    public function getDepartment()
    {
        $query = $this->db->table('department')->get();
        return $query->getResultArray();
    }
}
