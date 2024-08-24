<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function index(){
        return view('administrator/login');
    }

    public function menu(){
        return view('administrator.menu');
    }

    
}
