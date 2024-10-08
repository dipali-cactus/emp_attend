<?php namespace App\Controllers;

use App\Models\PublicModel;
use CodeIgniter\Controller;

class Profile extends BaseController
{
    protected $publicModel;
    protected $session;

    public function __construct()
    {
        // Load any necessary helper functions
        helper(['auth_helper']);

        // check if user loggedin or not
        isUserLoggedIn();


        // Initialize session service
        $this->session = \Config\Services::session();

        // Load the PublicModel
        $this->publicModel = new PublicModel();

        // Check if user is logged in
        if (!$this->session->get('username')) {
            return redirect()->to('/login'); // Redirect to login if not logged in
        }
    }

    public function index()
    {
        $data = [
            'title' => 'My Profile',
            'account' => $this->publicModel->getAllEmployeeData($this->session->get('username'))
        ];

        // Render views
        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('templates/topbar');
        echo view('profile/index', $data);
        echo view('templates/footer');
    }
}
