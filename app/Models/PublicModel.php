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

//         // Assuming you have a model or are using the database connection directly
// $db      = \Config\Database::connect();
// $builder = $db->table('attendance');

// // Build your query
// $builder->select('attendance.in_time AS date,
//                   attendance.shift_id AS shift,
//                   employee.name AS name,
//                   attendance.notes AS notes,
//                   attendance.image AS image,
//                   attendance.lack_of AS lack_of,
//                   attendance.in_status AS in_status,
//                   attendance.out_time AS out_time,
//                   attendance.out_status AS out_status,
//                   shift.start,
//                   shift.end');
// $builder->join('employee', 'attendance.employee_id = employee.id');
// $builder->join('employee_department', 'employee.id = employee_department.employee_id');
// $builder->join('department', 'employee_department.department_id = department.id');
// $builder->join('shift', 'employee.shift_id = shift.id');
// $builder->where('attendance.in_time >=', $start);
// $builder->where('attendance.in_time <=', $end);
// $builder->where('department.id', $dept);
// $builder->orderBy('attendance.in_time', 'ASC');

// // Get the compiled SQL query
// $sql = $builder->getCompiledSelect();

// echo $sql;exit;


        $query = $this->db->query("
            SELECT attendance.in_time AS date,
                   attendance.shift_id AS shift,
                   employee.name AS name,
                   attendance.notes AS notes,
                   attendance.image AS image,
                   attendance.lack_of AS lack_of,
                   attendance.in_status AS in_status,
                   attendance.out_time AS out_time,
                   attendance.out_status AS out_status,
                   shift.start as start,
                   shift.end as end
            FROM attendance
            INNER JOIN employee ON attendance.employee_id = employee.id
            INNER JOIN employee_department ON employee.id = employee_department.employee_id
            INNER JOIN department ON employee_department.department_id = department.id
            INNER JOIN shift ON employee.shift_id  = shift.id            
            WHERE attendance.in_time BETWEEN :start: AND :end:
              AND department.id = :dept:
            ORDER BY attendance.in_time ASC
        ", ['start' => $start, 'end' => $end, 'dept' => $dept]);

        return $query->getResultArray();
    }

    public function getEmpAttendance($e_id, $start, $end)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('attendance');

        $builder->select('attendance.in_time AS date,
                      attendance.shift_id AS shift,
                      employee.name AS name,
                      attendance.notes AS notes,
                      attendance.image AS image,
                      attendance.lack_of AS lack_of,
                      attendance.in_status AS in_status,
                      attendance.out_time AS out_time,
                      attendance.out_status AS out_status,
                      attendance.employee_id AS e_id,
                      shift.start,
                      shift.end');
        $builder->join('employee_department', 'attendance.employee_id = employee_department.employee_id');
        $builder->join('employee', 'attendance.employee_id = employee.id');
        $builder->join('shift', 'employee.shift_id = shift.id');
        $builder->where('employee.id', $e_id);

        if ($start)
            $builder->where('DATE(FROM_UNIXTIME(in_time)) >=', $start);

        if ($end)
            $builder->where('DATE(FROM_UNIXTIME(in_time)) <=', $end);

        $builder->orderBy('date', 'ASC');

        // Generate the SQL query as a string
        // $sqlQuery = $builder->getCompiledSelect();
        // echo "<br><br> Quryr <br>";
        // echo $sqlQuery; // Output the raw SQL query
        // exit;

        return $builder->get()->getResultArray();
    }


    public function getAllEmployeeData($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('users');

        // Get employee ID from users table
        $builder->select('employee_id');
        $builder->where('username', $username);
        $user = $builder->get()->getRowArray();
        $e_id = $user['employee_id'];

        // Join Query to get employee data
        $builder = $db->table('employee');
        $builder->select('employee.id AS id,
                      employee.name AS name,
                      employee.gender AS gender,
                      employee.image AS image,
                      employee.birth_date AS birth_date,
                      employee.hire_date AS hire_date,
                      department.name AS department');
        $builder->join('employee_department', 'employee.id = employee_department.employee_id');
        $builder->join('department', 'employee_department.department_id = department.id');
        $builder->where('employee.id', $e_id);

        return $builder->get()->getRowArray();
    }

    //     public function getEmpAttendance($e_id, $start, $end)
    // {
    //     $builder = $this->db->table('attendance');
    //     $builder->select('attendance.in_time AS date,
    //                       attendance.shift_id AS shift,
    //                       employee.name AS name,
    //                       attendance.notes AS notes,
    //                       attendance.image AS image,
    //                       attendance.lack_of AS lack_of,
    //                       attendance.in_status AS in_status,
    //                       attendance.out_time AS out_time,
    //                       attendance.out_status AS out_status,
    //                       attendance.employee_id AS e_id,
    //                       shift.start,
    //                       shift.end');
    //     $builder->join('employee_department', 'attendance.employee_id = employee_department.employee_id');
    //     $builder->join('employee', 'attendance.employee_id = employee.id');
    //     $builder->join('shift', 'employee.shift_id = shift.id');
    //     $builder->where('employee.id', $e_id);
    //     $builder->where('DATE(FROM_UNIXTIME(in_time)) >=', $start);
    //     $builder->where('DATE(FROM_UNIXTIME(in_time)) <=', $end);
    //     $builder->orderBy('date', 'ASC');

    //     $query = $builder->get();
    //     return $query->getResultArray();
    // }

}
