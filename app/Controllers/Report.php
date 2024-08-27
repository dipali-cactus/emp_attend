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
        // Prepare data
        $data = [
            'title' => 'Report',
            'account' => $this->adminModel->getAdmin($this->session->get('username')),
            'department' => $this->db->table('department')->get()->getResultArray(),
            'start' => $this->request->getGet('start'),
            'end' => $this->request->getGet('end'),
            'dept_code' => $this->request->getGet('dept'),
            'attendance' => $this->_attendanceDetails($this->request->getGet('start'), $this->request->getGet('end'), $this->request->getGet('dept'))
        ];

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
            return $this->publicModel->get_attendance($start, $end, $dept);
        }
    }

    public function print($start, $end, $dept)
    {
        $data = [
            'start' => $start,
            'end' => $end,
            'attendance' => $this->publicModel->get_attendance($start, $end, $dept),
            'dept' => $dept
        ];

        echo view('report/print', $data);
    }
}
