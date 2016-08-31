<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Nota;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['dashboard']]);
    }
    /**
     * dashboard view
     * @return view
     */
    public function dashboard()
    {
        return view('dashboard');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notas = Nota::where('status', 'Nueva')->get();
        return view('home',compact('notas'));
    }
}
