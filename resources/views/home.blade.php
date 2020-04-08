@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Bienvenido(a) {{auth()->user()->name}}</span>
                    <a href="{{ route('tramites.create') }}" class="btn btn-primary btn-sm">Nuevo Trámite</a>
                </div>

                <div class="card-body"> 
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if(session('danger'))
                    <div class="alert alert-danger">
                        {{ session('danger') }}
                    </div>
                    @endif
                    <form action="{{ route('tramites.mostrar') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="numeroRadicado">No. de radicado</label>
                        <input type="number" class="form-control" name="numeroRadicado">
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">Consultar Trámite</button>
                    </form>   
             
                    <!-- <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">No. radicado</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Título</th>
                            <th scope="col">Tema</th>
                            <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tramites as $tramite)
                            <tr>
                                <th scope="row">{{ $tramite->numeroRadicado }}</th>
                                <td>{{ $tramite->fecha }}</td>
                                <td>{{ $tramite->titulo }}</td>
                                <td>{{ $tramite->idTema }}</td>
                                <td>
                                <form action="{{ route('tramites.destroy', $tramite->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar Trámite</button>
                                </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$tramites->links()}} -->
                {{-- fin card body --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection