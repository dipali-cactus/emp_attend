<?php

namespace App\Models;

use CodeIgniter\Model;

class PublicModel extends Model
{
    protected $table = 'users';

    public function getAccount($username)
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
                   employee.hire_date AS `hire_date`,
                   department.id AS `department_id`
            FROM employee
            INNER JOIN employee_department ON employee.id = employee_department.employee_id
            INNER JOIN department ON employee_department.department_id = department.id
            WHERE `employee`.`id` = :e_id:
        ", ['e_id' => $e_id]);

        return $query->getRowArray();
    }

    public function get_attendance($start, $end, $dept)
    {
        $query = $this->db->query("
            SELECT attendance.in_time AS date,
                   attendance.shift_id AS shift,
                   employee.name AS name,
                   attendance.notes AS notes,
                   attendance.image AS image,
                   attendance.lack_of AS lack_of,
                   attendance.in_status AS in_status,
                   attendance.out_time AS out_time,
                   attendance.out_status AS out_status
            FROM attendance
            INNER JOIN employee ON attendance.employee_id = employee.id
            INNER JOIN employee_department ON employee.id = employee_department.employee_id
            INNER JOIN department ON employee_department.department_id = department.id
            WHERE attendance.in_time BETWEEN :start: AND :end:
              AND department.id = :dept:
            ORDER BY attendance.in_time ASC
        ", ['start' => $start, 'end' => $end, 'dept' => $dept]);

        return $query->getResultArray();
    }
}
