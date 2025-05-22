<?php

namespace Uzair3\Attendance\Controllers;

use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function index(){
        return view('attendance::departments/index');
    }
}
