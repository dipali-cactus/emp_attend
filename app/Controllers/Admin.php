<?php

namespace App\Controllers;

use App\Models\PublicModel;
use App\Models\AdminModel;
use CodeIgniter\Controller;

class Admin extends BaseController
{
    protected $validation;
    protected $publicModel;
    protected $adminModel;

    // Constructor
    public function __construct()
    {
        // Call the parent constructor
        //parent::__construct();

        // Load any necessary helper functions
        helper(['form', 'url','sak_helper']);

        // Load the form validation library
        $this->validation = \Config\Services::validation();

        // Load models
        $this->publicModel = new PublicModel();
        $this->adminModel = new AdminModel();

        // Custom methods
        is_weekends();
        is_logged_in();
        is_checked_in();
        is_checked_out();
    }

    // Dashboard
    public function index()
    {
      
        // Execute queries
        $db = \Config\Database::connect();

        $dquery = "SELECT department_id AS d_id, COUNT(employee_id) AS qty FROM employee_department GROUP BY d_id";
        $d['d_list'] = $db->query($dquery)->getResultArray();

        $squery = "SELECT e.shift_id AS s_id, COUNT(e.id) AS qty, s.start, s.end FROM employee e INNER JOIN `shift` s ON e.shift_id = s.id GROUP BY s_id";
        $d['s_list'] = $db->query($squery)->getResultArray();

        // Prepare data for views
        $d['title'] = 'Dashboard';
        $d['account'] = $this->adminModel->getAdmin(session()->get('username'));
        $d['display'] = $this->adminModel->getDataForDashboard();

        // Load views
        echo view('templates/dashboard_header', $d);
        echo view('templates/sidebar');
        echo view('templates/topbar');
        echo view('admin/index', $d); // Dashboard Page
        echo view('templates/dashboard_footer');
    }
}
