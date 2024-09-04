<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    protected $session;
    protected $formValidation;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->session = session();
        $this->formValidation = \Config\Services::validation();
    }

    public function index()
    {        
        if ($this->session->get('username')) {
            switch ($this->session->get('role_id')) {
                case 1:
                    return redirect()->to('/admin');
                case 2:
                    return redirect()->to('/profile');
            }
        }

        $data['title'] = 'Login Page';

        // Form Validation
        $this->formValidation->setRules([
            'username' => 'required|trim',
            'password' => 'required|trim|min_length[6]'
        ]);

        if (!$this->formValidation->withRequest($this->request)->run()) {
            echo view('templates/auth_header', $data);
            echo view('auth/index');
            echo view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    public function _login()
    {        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [];
                if($user['role_id'] === 1){
                    $data['admin_username'] = $user['username'];
                }else{
                    $data['username'] = $user['username'];
                }   
                $data['role_id'] = $user['role_id'];

                $this->session->set($data);
                switch ($user['role_id']) {
                    case 1:
                        return redirect()->to('/admin');    
                    case 2:
                        return redirect()->to('/profile');
                }
            } else {
                $this->session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                return redirect()->to('/auth');
            }
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-warning" role="alert">Username Not Found</div>');
            return redirect()->to('/auth');
        }
    }

    public function logout()
    {

        if($this->session->has('username'))
            $this->session->remove('username');

        if($this->session->has('admin_username'))
            $this->session->remove('admin_username');

        $this->session->remove('role_id');
        $this->session->setFlashdata('message', '<div class="alert alert-success" role="alert">Logged Out!</div>');
        return redirect()->to('/auth');
    }

    public function blocked()
    {
        $data['title'] = 'Access Blocked';
        echo view('auth/blocked', $data);
    }

    public function mytest(){
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'username' => $user['username'],
                    'role_id' => $user['role_id']
                ];                

                $this->session->set($data);

                switch ($user['role_id']) {
                    case 1:
                        return redirect()->to('/admin');    
                    case 2:
                        return redirect()->to('/profile');
                }
            } else {
                $this->session->setFlashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                return redirect()->to('/auth');
            }
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-warning" role="alert">Username Not Found</div>');
            return redirect()->to('/auth');
        }
    }
}
