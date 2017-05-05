<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PjController extends Controller
{
    public function index(){
      return view('penanggungJawab/penanggung_jawab_dashboard');
    }
}
