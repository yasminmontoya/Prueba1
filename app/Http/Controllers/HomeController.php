<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tramite;
use App\Tema;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuarioEmail = auth()->user()->email;
        $tramites = Tramite::where('usuario', $usuarioEmail)->paginate(5);
        return view('home',compact('tramites'));
    }
}
