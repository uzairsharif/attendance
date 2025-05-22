<?php

namespace Uzair3\Attendance\Controllers;

use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function index(){
        return view ('attendance::locations/index');
    }
}
