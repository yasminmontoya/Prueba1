<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tramite;
use App\Tema;

class TramiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarioEmail = auth()->user()->email;
        $tramites = Tramite::where('usuario', $usuarioEmail)->paginate(5);
        return view('home',compact('tramites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $temas=Tema::all();
        return view('tramites.crear',compact('temas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'numeroRadicado' => 'unique:tramites'
        ]);


        $temas = implode(",", $request->temas);
       
        $tramite = new Tramite();
        $tramite->numeroRadicado=$request->numeroRadicado;
        $tramite->fecha=$request->fecha." ".$request->hora;
        $tramite->titulo=$request->titulo;
        $tramite->temas=$temas;
        $tramite->usuario = auth()->user()->email;
        $tramite->save();

        return back()->with('success', 'Trámite Agregado!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tramite=Tramite::findOrFail($id);

        if($tramite!=""){
            return view('tramites.mostrar',compact('tramite'));
        }else{
            return back()->with('danger','No se encontro trámite con ese  No. de radicado');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tramite=Tramite::findOrFail($id);
        $tramite->delete();

        return redirect('/tramites')->with('success','Trámite Eliminado!');
    }

    public function mostrar(Request $request) {

        $temas=Tema::all();
        $numeroRadicado=$request->numeroRadicado;
        $tramite=Tramite::where('numeroRadicado','=',$numeroRadicado)->first();

        if($tramite!=""){
            return view('tramites.mostrar',compact('tramite','temas'));
        }else{
            return back()->with('danger','No se encontro trámite con ese  No. de radicado');
        }
    }
}
