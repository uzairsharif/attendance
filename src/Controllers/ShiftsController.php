<?php

namespace Uzair3\Attendance\Controllers;

use Illuminate\Http\Request;

class ShiftsController extends Controller
{
    public function index(){
        return view('attendance::shifts/index');
    }
}
