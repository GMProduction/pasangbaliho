<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardControll extends Controller
{
    //
    public function index(){
        return view('admin.layout');
    }
}
