<?php

namespace App\Controllers;

use App\Models\PublicModel;
use App\Models\AdminModel;
use CodeIgniter\Controller;

class Attendance extends BaseController
{
    protected $publicModel;
    protected $adminModel;
    protected $session;
    protected $formValidation;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->publicModel = new PublicModel();
        $this->adminModel = new AdminModel();
        $this->session = session();
        $this->formValidation = \Config\Services::validation();
        
        is_weekends();
        is_logged_in();
        is_checked_in();
        is_checked_out();
    }

    public function index()
    {
        // Attendance Form
        $data['title'] = 'Attendance Form';
        $data['account'] = $this->publicModel->getAccount($this->session->get('username'));
        $data['location'] = (new \App\Models\LocationModel())->findAll();

        // If Weekends
        if (is_weekends() == true) {
            $data['weekends'] = true;
            echo view('templates/header', $data);
            echo view('templates/sidebar');
            echo view('templates/topbar');
            echo view('attendance/index', $data); // Attendance Form Page
            echo view('templates/footer');
        } else {
            $data['in'] = true;
            $data['weekends'] = false;

            // If haven't Time In Today
            if (is_checked_in() == false) {
                $data['in'] = false;

                $this->formValidation->setRules([
                    'work_shift' => 'required|trim',
                    'location' => 'required|trim'
                ]);

                if ($this->formValidation->run() == false) {
                    $shift = $data['account']['shift'];
                    $resultShift = (new \App\Models\ShiftModel())->find($shift);
                    $data['time'] = date('H:i:s');
                    
                    echo view('templates/header', $data);
                    echo view('templates/sidebar');
                    echo view('templates/topbar');
                    echo view('attendance/index', $data); // Attendance Form Page
                    echo view('templates/footer');
                } else {
                    // Code for when the form validation passes
                }
            }
        }
    }
}
