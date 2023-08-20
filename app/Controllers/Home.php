<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('Templates/dashboard.php');
    }
    public function login()
    {
        // if(session('user')['firstName'] && session('user')['email']){
        //    return redirect()->to('dashboard');
        // }
        return view('Templates/Login.php');
    }
  
}
