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

    echo view('templates/header', $data);
    echo view('templates/sidebar');
    echo view('templates/topbar');
    echo view('master/department/a_dept', $data); // Add Department Page
    echo view('templates/footer');
  }

  public function addDept()
  {
    $data = [
      'id' => $this->request->getPost('d_id'),
      'name' => $this->request->getPost('d_name')
    ];

    // Form Validation
    $this->formValidation->setRules([
      'd_id' => 'required|trim|exact_length[3]|alpha',
      'd_name' => 'required|trim'
    ]);

    if ($this->formValidation->withRequest($this->request)->run()) {
      $builder = $this->db->table('department');
      $checkId = $builder->where('id', $data['id'])->countAllResults();

      if ($checkId > 0) {
        $this->session->setFlashdata('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">Failed to add, ID used!</div>');
      } else {
        $builder->insert($data);
        $this->session->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">Successfully added a new department!</div>');
        //return redirect()->to('master/e_dept/' . $this->request->getPost('d_id'));
        return redirect()->to('master');
      }
    }
    return redirect()->back()->withInput()->with('errors', $this->formValidation->getErrors());
  }

  public function e_dept($d_id)
  {
    $d_old = $this->db->table('department')->where('id', $d_id)->get()->getRowArray();

    if (!$d_old) {
      return redirect()->back()->withInput()->with('error', "Invalid Department ID.");
    }
    $data = [
      'title' => 'Department',
      'd_old' => $d_old,
      'account' => $this->adminModel->getAdmin($this->session->get('username'))
    ];

    echo view('templates/header', $data);
    echo view('templates/sidebar');
    echo view('templates/topbar');
    echo view('master/department/e_dept', $data); // Edit Department Page
    echo view('templates/footer');
  }

  public function editDept()
  {
    $data = [
      'id' => $this->request->getPost('d_id'),
      'name' => $this->request->getPost('d_name')
    ];

    // Form Validation
    $this->formValidation->setRules([
      'd_id' => 'required|trim|exact_length[3]|alpha',
      'd_name' => 'required|trim'
    ]);

    if ($this->formValidation->withRequest($this->request)->run()) {
      $builder = $this->db->table('department');
      $checkId = $builder->where('id', $data['id'])->countAllResults();

      if ($checkId > 0) {
        $this->session->setFlashdata('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">Failed to add, ID used!</div>');
      }

      $builder = $this->db->table('department');
      $builder->update($data, ['id' => $data['id']]);
      $this->session->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">Successfully edited a department!</div>');
      return redirect()->to('master');
    }

    return redirect()->back()->withInput()->with('errors', $this->formValidation->getErrors());
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

    echo view('templates/header', $data);
    echo view('templates/sidebar');
    echo view('templates/topbar');
    echo view('master/shift/a_shift', $data); // Add Shift Page
    echo view('templates/footer');
  }

  public function addShift()
  {
    // Form Validation
    $this->formValidation->setRules([
      's_start_h' => 'required|trim',
      's_start_m' => 'required|trim',
      's_start_s' => 'required|trim',
      's_end_h' => 'required|trim',
      's_end_m' => 'required|trim',
      's_end_s' => 'required|trim'
    ]);

    if (! $this->formValidation->withRequest($this->request)->run()) {
      return redirect()->back()->withInput()->with('errors', $this->formValidation->getErrors());
    }

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
      return redirect()->to('master/shift');
    } else {
      return redirect()->back()->withInput()->with('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">Failed to add new shift!</div>');
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
      $this->editShift($s_id);
    } else {
      $data['validation'] = $this->formValidation;
    }

    echo view('templates/header', $data);
    echo view('templates/sidebar');
    echo view('templates/topbar');
    echo view('master/shift/e_shift', $data); // Edit Shift Page
    echo view('templates/footer');
  }

  public function editShift($s_id)
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
    return redirect()->to('master/shift');
  }

  public function d_shift($s_id)
  {
    $this->db->table('shift')->delete(['id' => $s_id]);
    $this->session->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">Successfully deleted shift!</div>');
    return redirect()->to('master/shift');
  }

  public function employee()
  {
    // Employee Data
    $d['title'] = 'Employee';
    $d['employee'] = $this->db->query("SELECT e.*,s.start, s.end FROM `employee` e inner join `shift` s on e.shift_id = s.id order by `name` asc")->getResultArray();
    $d['account'] = $this->adminModel->getAdmin($this->session->get('username'));

    echo view('templates/table_header', $d);
    echo view('templates/sidebar');
    echo view('templates/topbar');
    echo view('master/employee/index', $d); // Employee Page
    echo view('templates/table_footer');
  }

  public function a_employee()
  {
    // Add Employee
    $d['title'] = 'Employee';
    $d['department'] = $this->db->table('department')->get()->getResultArray();
    $d['shift'] = $this->db->table('shift')->get()->getResultArray();
    $d['account'] = $this->adminModel->getAdmin($this->session->get('username'));

    $validation =  \Config\Services::validation();

    $validation->setRules([
      'e_name'      => 'required|trim',
      'email'       => 'required|trim|valid_email',
      's_id'        => 'required|trim',
      'e_gender'    => 'required',
      'e_birth_date' => 'required|trim',
      'e_hire_date' => 'required|trim',
    ]);

    if (!$validation->withRequest($this->request)->run()) {
      //return redirect()->back()->withInput()->with('errors', $validation->getErrors());
      $data['validation'] = $validation;
    } else {
      $this->_addEmployee();
    }

    echo view('templates/header', $d);
    echo view('templates/sidebar');
    echo view('templates/topbar');
    echo view('master/employee/a_employee', $d); // Add Employee Page
    echo view('templates/footer');
  }

  // public function _addEmployee()
  // {
  //   $name = $this->request->getPost('e_name');
  //   $department = $this->request->getPost('d_id');
  //   $email = $this->request->getPost('email');
  //   $gender = $this->request->getPost('e_gender');
  //   $birth_date = $this->request->getPost('e_birth_date');
  //   $hire_date = $this->request->getPost('e_hire_date');
  //   $shift_id = $this->request->getPost('s_id');

  //   // Check Email
  //   $checkEmail = $this->db->table('employee')->where('email', $email)->countAllResults();

  //   if ($checkEmail > 0) {
  //     session()->setFlashdata('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">
  //       Email already used!</div>');
  //   } else {
  //     // Config Upload Image
  //     $config = [
  //       'upload_path'   => './images/pp/',
  //       'allowed_types' => 'jpg|png|jpeg',
  //       'max_size'      => '2048',
  //       'file_name'     => 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10),
  //     ];

  //     $upload = \Config\Services::upload();
  //     $upload->initialize($config);

  //     if ($this->request->getFile('image')->isValid()) {
  //       if ($upload->doUpload('image')) {
  //         $image = $upload->getName();
  //       }
  //     } else {
  //       $image = 'default.png';
  //     }

  //     $data = [
  //       'name'       => $name,
  //       'email'      => $email,
  //       'gender'     => $gender,
  //       'image'      => $image,
  //       'birth_date' => $birth_date,
  //       'hire_date'  => $hire_date,
  //       'shift_id'   => $shift_id,
  //     ];

  //     $this->db->table('employee')->insert($data);
  //     $getEmp = $this->db->table('employee')->where('email', $email)->get()->getRowArray();
  //     $e_id = $getEmp['id'];

  //     $d = [
  //       'department_id' => $department,
  //       'employee_id'   => $e_id,
  //     ];

  //     $this->db->table('employee_department')->insert($d);
  //     $rows = $this->db->affectedRows();

  //     if ($rows > 0) {
  //       session()->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">
  //           Successfully added a new employee!</div>');
  //     } else {
  //       session()->setFlashdata('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">
  //           Failed to add data!</div>');
  //     }
  //     return redirect()->to('master/e_employee/' . $e_id);
  //   }
  // }


  public function _addEmployee()
  {
    $name = $this->request->getPost('e_name');
    $department = $this->request->getPost('d_id');
    $email = $this->request->getPost('email');
    $gender = $this->request->getPost('e_gender');
    $birth_date = $this->request->getPost('e_birth_date');
    $hire_date = $this->request->getPost('e_hire_date');
    $shift_id = $this->request->getPost('s_id');

    // Check Email
    $checkEmail = $this->db->table('employee')->where('email', $email)->countAllResults();

    if ($checkEmail > 0) {
      session()->setFlashdata('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">
            Email already used!</div>');
    } else {
      // Config Upload Image
      // Config Upload Image
      $file = $this->request->getFile('image');
      $image = 'default.png';

      if ($file && $file->isValid()) {
        $imageName = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10) . '.' . $file->getExtension();
        $file->move(WRITEPATH . 'uploads/images/pp/', $imageName);
        $image = $imageName;
      }

      $data = [
        'name'       => $name,
        'email'      => $email,
        'gender'     => $gender,
        'image'      => $image,
        'birth_date' => $birth_date,
        'hire_date'  => $hire_date,
        'shift_id'   => $shift_id,
      ];

      $this->db->table('employee')->insert($data);
      $e_id = $this->db->insertID();

      $d = [
        'department_id' => $department,
        'employee_id'   => $e_id,
      ];

      $this->db->table('employee_department')->insert($d);
      $rows = $this->db->affectedRows();

      if ($rows > 0) {
        session()->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">
                Successfully added a new employee!</div>');
      } else {
        session()->setFlashdata('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">
                Failed to add data!</div>');
      }
      return redirect()->to('master/employee');
    }
  }



  public function e_employee($e_id)
  {
    $d = [];
    $d['title'] = 'Employee';
    $d['employee'] = $this->db->table('employee')->where('id', $e_id)->get()->getRowArray();
    $d['department_current'] = $this->db->table('employee_department')->where('employee_id', $e_id)->get()->getRowArray();
    $d['department'] = $this->db->table('department')->get()->getResultArray();
    $d['shift'] = $this->db->table('shift')->get()->getResultArray();
    $d['account'] = $this->adminModel->getAdmin(session()->get('username'));

    // Load the validation library and set rules
    $validation = \Config\Services::validation();
    $validation->setRules([
      'e_name' => 'required|trim',
      'e_gender' => 'required',
      'e_birth_date' => 'required|trim',
      'e_hire_date' => 'required|trim',
      's_id' => 'required|trim',
      'd_id' => 'required|trim'
    ]);

    if (service('request')->getMethod() === 'post' && $validation->withRequest($this->request)->run()) {
      $name = $this->request->getPost('e_name');
      $gender = $this->request->getPost('e_gender');
      $birth_date = $this->request->getPost('e_birth_date');
      $hire_date = $this->request->getPost('e_hire_date');
      $d_id = $this->request->getPost('d_id');
      $s_id = $this->request->getPost('s_id');

      // Handle file upload
      $image = 'default.png';
      if ($this->request->getFile('image')->isValid()) {
        $file = $this->request->getFile('image');
        if ($file) {
          $imageName = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10) . '.' . $file->getExtension();
          $upload_success = $file->move(WRITEPATH . 'uploads/images/pp/', $imageName);
          $image = $imageName;
        }

        // Delete old image if not default
        if ($upload_success && $d['employee']['image'] != 'default.png') {
          unlink(WRITEPATH . 'uploads/images/pp/' . $d['employee']['image']);
        }
      } else {
        $image = $d['employee']['image'];
      }

      $data = [
        'name' => $name,
        'gender' => $gender,
        'image' => $image,
        'birth_date' => $birth_date,
        'hire_date' => $hire_date,
        'shift_id' => $s_id
      ];
      $department = [
        'department_id' => $d_id
      ];
      $this->_editEmployee($e_id, $data, $department);
    }

    echo view('templates/header', $d);
    echo view('templates/sidebar');
    echo view('templates/topbar');
    echo view('master/employee/e_employee', $d); // Edit Employee Page
    echo view('templates/footer');
  }

  public function _editEmployee($e_id, array $data, array $department)
  {
    // Update employee data
    $builder = $this->db->table('employee');
    $builder->update($data, ['id' => $e_id]);
    $upd1 = $this->db->affectedRows();

    // Update employee department data
    $builder = $this->db->table('employee_department');
    $builder->update($department, ['employee_id' => $e_id]);
    $upd2 = $this->db->affectedRows();

    if ($upd1 > 0 || $upd2 > 0) {
      $this->session->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">
            Successfully updated an employee!</div>');
    } else {
      $dbError = $this->db->error();
      if (!empty($dbError['message'])) {
        $this->session->setFlashdata('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">
                Failed to update employee\'s data!</div>');
      } else {
        $this->session->setFlashdata('message', '<div class="alert alert-warning rounded-0 mb-2" role="alert">
                There\'s no field has changed.</div>');
      }
    }

    return redirect()->to('master/employee');
  }

  public function d_employee($e_id)
  {
    // Delete employee record
    $builder = $this->db->table('employee');
    $builder->delete(['id' => $e_id]);

    // Set flash message
    $this->session->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">
        Successfully deleted an employee!</div>');

    // Redirect to employee list
    return redirect()->to('master/employee');
  }
  public function location()
  {
    $data = [
      'title' => 'Location',
      'location' => $this->db->table('location')->get()->getResultArray(),
      'account' => $this->adminModel->getAdmin(session()->get('username'))
    ];

    return view('templates/table_header', $data)
      . view('templates/sidebar')
      . view('templates/topbar')
      . view('master/location/index', $data)
      . view('templates/table_footer');
  }

  public function a_location()
  {
    $data = [
      'title' => 'Location',
      'account' => $this->adminModel->getAdmin(session()->get('username'))
    ];

    $validation = \Config\Services::validation();
    $validation->setRules([
      'l_name' => 'required|trim'
    ]);

    if (service('request')->getMethod() === 'post' && $validation->withRequest($this->request)->run()) {
      $locationData = [
        'name' => $this->request->getPost('l_name')
      ];
      $this->_addLocation($locationData);
    }

    return view('templates/header', $data)
      . view('templates/sidebar')
      . view('templates/topbar')
      . view('master/location/a_location', $data)
      . view('templates/footer');
  }
  public function _addLocation($data)
  {
    // Get the Database instance
    $db = \Config\Database::connect();

    // Insert the data into the 'location' table
    $builder = $db->table('location');
    $builder->insert($data);
    $insertID = $db->insertID(); // Get the last inserted ID

    // Check if the insert was successful
    if ($insertID) {
      // Set success message in the session
      session()->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">
        Successfully added a new location!</div>');
      // Redirect to the location details page
      return redirect()->to('master/location');
    } else {
      // Set error message in the session
      session()->setFlashdata('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">
        Failed to add data!</div>');
    }
  }
  public function e_location($l_id)
  {
    // Edit Location
    $data['title'] = 'Location';

    // Get the Database instance
    $db = \Config\Database::connect();

    // Retrieve existing location data
    $builder = $db->table('location');
    $data['l_old'] = $builder->where('id', $l_id)->get()->getRowArray();

    // Get the admin account information
    $data['account'] = $this->adminModel->getAdmin(session()->get('username'));

    // Load the Validation library
    $validation = \Config\Services::validation();

    // Set validation rules
    $validation->setRules([
      'l_name' => 'required|trim'
    ]);

    if (service('request')->getMethod() === 'post' && $validation->withRequest($this->request)->run()) {
      $name = $this->request->getPost('l_name');
      $this->_editLocation($l_id, $name);
    }

    // Load views
    echo view('templates/header', $data);
    echo view('templates/sidebar');
    echo view('templates/topbar');
    echo view('master/Location/e_location', $data); // Edit Location Page
    echo view('templates/footer');
  }

  public function _editLocation($l_id, $name)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('location');

    $data = ['name' => $name];
    $builder->update($data, ['id' => $l_id]);
    $rows = $db->affectedRows();

    if ($rows > 0) {
      session()->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">
            Successfully edited a location!</div>');
      return redirect()->to('master/e_location/' . $l_id);
    } else {
      $error = $db->error();
      if (!empty($error['message'])) {
        session()->setFlashdata('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">
            Failed to edit data!</div>');
      } else {
        session()->setFlashdata('message', '<div class="alert alert-warning rounded-0 mb-2" role="alert">
            No Changes!</div>');
      }
      return redirect()->to('master/location');
    }
  }

  public function d_location($l_id)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('location');

    // Reset AUTO_INCREMENT
    $db->query('ALTER TABLE location AUTO_INCREMENT = 1');

    // Delete the location
    $builder->delete(['id' => $l_id]);
    $rows = $db->affectedRows();

    // Set flashdata message
    if ($rows > 0) {
      session()->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">
            Successfully deleted a location!</div>');
    } else {
      session()->setFlashdata('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">
            Failed to delete a data!</div>');
    }

    // Redirect to location list
    return redirect()->to('master/location');
  }

  // end of location

  public function users()
  {
    $db = \Config\Database::connect();
    $builder = $db->query("SELECT employee_department.employee_id AS e_id,
                                  employee_department.department_id AS d_id,
                                  users.username AS u_username,
                                  employee.name AS e_name
                             FROM employee_department
                        LEFT JOIN users
                               ON employee_department.employee_id = users.employee_id
                       INNER JOIN employee
                               ON employee_department.employee_id = employee.id");

    $d['title'] = 'Users';
    $d['data'] = $builder->getResultArray();
    $d['account'] = $this->adminModel->getAdmin(session()->get('username'));

    echo view('templates/table_header', $d);
    echo view('templates/sidebar');
    echo view('templates/topbar');
    echo view('master/users/index', $d);
    echo view('templates/table_footer');
  }


  public function a_users($e_id)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('employee_department');
    $empDep = $builder->where('employee_id', $e_id)->get()->getRowArray();

    $d['title'] = 'Users';
    $d['username'] = $empDep['department_id'] . $empDep['employee_id'];
    $d['e_id'] = $empDep['employee_id'];
    $d['account'] = $this->adminModel->getAdmin(session()->get('username'));

    $validation = \Config\Services::validation();
    $validation->setRules([
      'u_username' => [
        'label' => 'Username',
        'rules' => 'required|trim|min_length[6]'
      ],
      'u_password' => [
        'label' => 'Password',
        'rules' => 'required|trim|min_length[6]'
      ]
    ]);

   
    if (service('request')->getMethod() === 'post' && $validation->withRequest($this->request)->run()) {
      $username = $this->request->getPost('u_username');
      $role_id = ($empDep['department_id'] != 'ADM') ? 2 : 1;
      $data = [
        'username' => $username,
        'password' => password_hash($this->request->getPost('u_password'), PASSWORD_DEFAULT),
        'employee_id' => $this->request->getPost('e_id'),
        'role_id' => $role_id
      ];
      $this->_addUsers($data);
      return redirect()->to('master/users');
      
    } else {
      echo view('templates/header', $d);
      echo view('templates/sidebar');
      echo view('templates/topbar');
      echo view('master/users/a_users', $d);
      echo view('templates/footer');
    }   
  }

  public function _addUsers(array $data)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('users');

    $builder->insert($data);
    $rows = $db->affectedRows();

    if ($rows > 0) {
      session()->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">
            Successfully created an account!</div>');
    } else {
      session()->setFlashdata('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">
            Failed to create account!</div>');
    }

    return redirect()->to('master/users');
  }

  public function e_users(string $username)
  {

    $db = \Config\Database::connect();
    $builder = $db->table('users');

    $d['title'] = 'Users';
    $d['users'] = $builder->where('username', $username)->get()->getRowArray();
    $d['account'] = $this->adminModel->getAdmin(session()->get('username'));

    $validation = \Config\Services::validation();
    $validation->setRules([
      'password' => [
        'label'  => 'Password',
        'rules'  => 'required|trim|min_length[6]',
      ]
    ]);

    //if (!$validation->withRequest($this->request)->run()) {

    if (service('request')->getMethod() === 'post' && $validation->withRequest($this->request)->run()) 
    {
      $data = ['password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)];    
      $this->_editUsers($data, $username);
      return redirect()->to('master/users');
    } 
    else
    {
      echo view('templates/header', $d);
      echo view('templates/sidebar');
      echo view('templates/topbar');
      echo view('master/users/e_users', $d);
      echo view('templates/footer');
    }
  }

  public function _editUsers(array $data, string $username)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('users');

    // Perform the update
    $builder->update($data, ['username' => $username]);

    // Check if rows were affected
    $rows = $db->affectedRows();

    // Set flash data based on the result
    if ($rows > 0) {
      session()->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">
            Successfully edited an account!</div>');
    } else {
      session()->setFlashdata('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">
            Failed to edit account!</div>');
    }
    // Redirect
    return redirect()->to('master/users');
  }

  public function d_users(string $username)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('users');

    // Perform the delete operation
    $builder->delete(['username' => $username]);

    // Check if rows were affected
    $rows = $db->affectedRows();

    // Set flash data based on the result
    if ($rows > 0) {
      session()->setFlashdata('message', '<div class="alert alert-success rounded-0 mb-2" role="alert">
            Successfully deleted an account!</div>');
    } else {
      session()->setFlashdata('message', '<div class="alert alert-danger rounded-0 mb-2" role="alert">
            Failed to delete account!</div>');
    }

    // Redirect
    return redirect()->to('master/users');
  }
}
