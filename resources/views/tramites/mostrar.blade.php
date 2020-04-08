@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                <span>Consultar Trámite</span>
                    <a href="{{ route('tramites.index') }}" class="btn btn-primary btn-sm">Volver</a>
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
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">No. radicado</th>
                            <th scope="col">Fecha - Hora</th>
                            <th scope="col">Título</th>
                            <th scope="col">Temas</th>
                            <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">{{ $tramite->numeroRadicado }}</th>
                                <td>{{ $tramite->fecha }}</td>
                                <td>{{ $tramite->titulo }}</td>
                                <td>{{ $tramite->temas }}</td>
                                <td>
                                <form action="{{ route('tramites.destroy', $tramite->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este trámite?')">Eliminar Trámite</button>
                                </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                {{-- fin card body --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection