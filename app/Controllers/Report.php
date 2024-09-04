<?php namespace App\Controllers;

use App\Models\PublicModel;
use App\Models\AdminModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class Report extends BaseController
{
    protected $publicModel;
    protected $adminModel;
    protected $session;
    protected $db;

    public function __construct()
    {
        // Initialize session service
        $this->session = \Config\Services::session();

        // Load models
        $this->publicModel = new PublicModel();
        $this->adminModel = new AdminModel();

        // Initialize database connection
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $start_time = $this->request->getGet('start');
        $end_time = $this->request->getGet('end');
        $dept_id = $this->request->getGet('dept');
       
        // Prepare data
        $data = [
            'title' => 'Report',
            'account' => $this->adminModel->getAdmin($this->session->get('username')),
            'department' => $this->db->table('department')->get()->getResultArray(),
            'start' => $start_time ? $start_time : '',
            'end' => $end_time ? $end_time : '',
            'dept_code' => $dept_id,
            'attendance' => $this->_attendanceDetails($start_time, $end_time, $dept_id)
        ];

        //echo "<br><pre>"print_r($data);exit;

        // Render views
        echo view('templates/table_header', $data);
        echo view('templates/sidebar');
        echo view('templates/topbar');
        echo view('report/index', $data);
        echo view('templates/table_footer');
    }

    private function _attendanceDetails($start, $end, $dept)
    {
        if (empty($start) || empty($end)) {
            return false;
        } else {
            $start_time = $start . ' 00:00:00';
            $end_time = $end. ' 23:59:59';
            return $this->publicModel->get_attendance(strtotime($start_time), strtotime($end_time), $dept);
        }
    }

    public function print($start, $end, $dept)
    {
        $start_time = $start . ' 00:00:00';
        $end_time = $end. ' 23:59:59';
        $data = [
            'start' => $start,
            'end' => $end,
            'attendance' => $this->publicModel->get_attendance(strtotime($start_time), strtotime($end_time), $dept),
            'dept' => $dept
        ];

        echo view('report/print', $data);
    }
}
