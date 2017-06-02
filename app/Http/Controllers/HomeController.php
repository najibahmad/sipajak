<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      switch (Auth::user()->role_id) {
        case '1':
            return redirect('/admin');
          break;
        case '2':
            return redirect('/penanggungJawab');
          break;
        case '3':
            return redirect('/bendahara');
          break;
        case '4':
            return redirect('/operator');
          break;
        case '5':
            return redirect('/verifikator');
          break;
        default:
            return redirect('/home');
          break;
      }
        //return view('home');
    }
}
