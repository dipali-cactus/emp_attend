<?php

namespace App\Controllers;

use App\Models\PublicModel;
use App\Models\AdminModel;
use CodeIgniter\Controller;
use CodeIgniter\Files\File;

class Master extends BaseController
{
    protected $formValidation;
    protected $adminModel;
    protected $publicModel;
    protected $session;
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->formValidation = \Config\Services::validation();
        $this->adminModel = new AdminModel();
        $this->publicModel = new PublicModel();
        $this->session = session(); // Load the session
    }

    public function index()
    {
        $data = [
            'title' => 'Department',
            'department' => $this->db->table('department')->get()->getResultArray(),
            'account' => $this->adminModel->getAdmin($this->session->get('username'))
        ];

        echo view('templates/table_header', $data);
        echo view('templates/sidebar');
        echo view('templates/topbar');
        echo view('master/department/index', $data); // Department Page
        echo view('templates/table_footer');
    }

    public function a_dept()
    {
        $data = [
            'title' => 'Department',
            'account' => $this->adminModel->getAdmin($this->session->get('username'))
        ];

        // Form Validation
        $this->formValidation->setRules([
            'd_id' => 'required|trim|exact_length[3]|alpha',
            'd_name' => 'required|trim'
        ]);

        if ($this->formValidation->withRequest($this->request)->run()) {
            $this->_addDept();
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('templates/topbar');
        echo view('master/department/a_dept', $data); // Add Department Page
        echo view('templates/footer');
    }

    private function _addDept()
    {
        $data = [
            'id' => $this->request->getPost('d_id'),
            'name' => $this->request->getPost('d_name')
        ];

        $builder = $this->db->table('department');
        $checkId = $builder->where('id', $data['id'])->countAllResults();

        if ($checkId > 0) {
            $this->session->setFlashdata('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">Failed to add, ID used!</div>');
        } else {
            $builder->insert($data);
            $this->session->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">Successfully added a new department!</div>');
            return redirect()->to('master/e_dept/' . $this->request->getPost('d_id'));
        }
    }

    public function e_dept($d_id)
    {
        $data = [
            'title' => 'Department',
            'd_old' => $this->db->table('department')->where('id', $d_id)->get()->getRowArray(),
            'account' => $this->adminModel->getAdmin($this->session->get('username'))
        ];

        // Form Validation
        $this->formValidation->setRules([
            'd_name' => 'required|trim'
        ]);

        if ($this->formValidation->withRequest($this->request)->run()) {
            $name = $this->request->getPost('d_name');
            $this->_editDept($d_id, $name);
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('templates/topbar');
        echo view('master/department/e_dept', $data); // Edit Department Page
        echo view('templates/footer');
    }

    private function _editDept($d_id, $name)
    {
        $data = ['name' => $name];
        $builder = $this->db->table('department');
        $builder->update($data, ['id' => $d_id]);
        $this->session->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">Successfully edited a department!</div>');
        return redirect()->to('master/e_dept/' . $d_id);
    }

    public function d_dept($d_id)
    {
        $this->db->table('department')->delete(['id' => $d_id]);
        $this->session->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">Successfully deleted a department!</div>');
        return redirect()->to('master');
    }

    public function shift()
    {
        $data = [
            'title' => 'Shift',
            'shift' => $this->db->table('shift')->get()->getResultArray(),
            'account' => $this->adminModel->getAdmin($this->session->get('username'))
        ];

        echo view('templates/table_header', $data);
        echo view('templates/sidebar');
        echo view('templates/topbar');
        echo view('master/shift/index', $data); // Shift Page
        echo view('templates/table_footer');
    }

    public function a_shift()
    {
        $generateID = $this->db->table('shift')->countAllResults();
        $data = [
            'title' => 'Shift',
            's_id' => $generateID + 1,
            'account' => $this->adminModel->getAdmin($this->session->get('username'))
        ];

        // Form Validation
        $this->formValidation->setRules([
            's_start_h' => 'required|trim',
            's_start_m' => 'required|trim',
            's_start_s' => 'required|trim',
            's_end_h' => 'required|trim',
            's_end_m' => 'required|trim',
            's_end_s' => 'required|trim'
        ]);

        if ($this->formValidation->withRequest($this->request)->run()) {
            $this->_addShift();
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('templates/topbar');
        echo view('master/shift/a_shift', $data); // Add Shift Page
        echo view('templates/footer');
    }

    private function _addShift()
    {
        $sHour = $this->request->getPost('s_start_h');
        $sMinutes = $this->request->getPost('s_start_m');
        $sSeconds = $this->request->getPost('s_start_s');
        $eHour = $this->request->getPost('s_end_h');
        $eMinutes = $this->request->getPost('s_end_m');
        $eSeconds = $this->request->getPost('s_end_s');

        $data = [
            'start' => $sHour . ':' . $sMinutes . ':' . $sSeconds,
            'end' => $eHour . ':' . $eMinutes . ':' . $eSeconds,
        ];

        $builder = $this->db->table('shift');
        $builder->insert($data);
        $id = $this->db->insertID();
        $affectedRow = $this->db->affectedRows();

        if ($affectedRow > 0) {
            $this->session->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">Successfully added a new shift!</div>');
            return redirect()->to('master/e_shift/' . $id);
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">Failed to add new shift!</div>');
        }
    }

    public function e_shift($s_id)
    {
        $data = $this->db->table('shift')->where('id', $s_id)->get()->getRowArray();
        $start = explode(':', $data['start']);
        $end = explode(':', $data['end']);

        $data = [
            'title' => 'Shift',
            's_id' => $data['id'],
            's_sh' => $start[0],
            's_sm' => $start[1],
            's_ss' => $start[2],
            's_eh' => $end[0],
            's_em' => $end[1],
            's_es' => $end[2],
            'account' => $this->adminModel->getAdmin($this->session->get('username'))
        ];

        // Form Validation
        $this->formValidation->setRules([
            's_start_h' => 'required|trim',
            's_start_m' => 'required|trim',
            's_start_s' => 'required|trim',
            's_end_h' => 'required|trim',
            's_end_m' => 'required|trim',
            's_end_s' => 'required|trim'
        ]);

        if ($this->formValidation->withRequest($this->request)->run()) {
            $this->_editShift($s_id);
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('templates/topbar');
        echo view('master/shift/e_shift', $data); // Edit Shift Page
        echo view('templates/footer');
    }

    private function _editShift($s_id)
    {
        $sHour = $this->request->getPost('s_start_h');
        $sMinutes = $this->request->getPost('s_start_m');
        $sSeconds = $this->request->getPost('s_start_s');
        $eHour = $this->request->getPost('s_end_h');
        $eMinutes = $this->request->getPost('s_end_m');
        $eSeconds = $this->request->getPost('s_end_s');

        $data = [
            'start' => $sHour . ':' . $sMinutes . ':' . $sSeconds,
            'end' => $eHour . ':' . $eMinutes . ':' . $eSeconds,
        ];

        $builder = $this->db->table('shift');
        $builder->update($data, ['id' => $s_id]);
        $this->session->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">Successfully updated shift!</div>');
        return redirect()->to('master/e_shift/' . $s_id);
    }

    public function d_shift($s_id)
    {
        $this->db->table('shift')->delete(['id' => $s_id]);
        $this->session->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">Successfully deleted shift!</div>');
        return redirect()->to('master/shift');
    }
}
