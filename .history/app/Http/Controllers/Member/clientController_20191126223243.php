<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class clientController extends Controller
{
    //
    public function showDashboard()
    {
            return view('client.index');
    }
}