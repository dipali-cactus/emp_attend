<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function mytest(){
        echo $this->request->getPost('username');echo "<br>";
        echo $this->request->getPost('password');echo "<br>";
        echo "My test"; exit;
    }
}
