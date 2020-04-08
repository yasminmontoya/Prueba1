@extends('layouts.app')

@section('scripts')
<script>
    $(document).ready(function(){
        window.addEventListener("load", function() {
        form.numeroRadicado.addEventListener("keypress", soloNumeros, false);
        });

        function soloNumeros(e){
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            e.preventDefault();
        }
        }

        $("#temas").change(function(){
		
        var texto = "Valores Seleccionados: ";
        $("#temas option:selected").each(function() {			
          texto += $(this).text() + ",";			
        });

        //alert(texto);
            
        });	
    });
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Agregar Trámite</span>
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
                <form name="form" action="{{ route('tramites.store') }}" method="POST">
                @csrf
                @error('numeroRadicado')
                    <div class="alert alert-danger">
                    Ya existe un trámite con ese no. de radicado!
                    </div>
                @enderror 
                <div class="form-group">
                    <label for="numeroRadicado">No. de radicado</label>
                    <input type="text" class="form-control" name="numeroRadicado" value="{{ old('numeroRadicado') }}" required>
                </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control" name="fecha" min="2007-01-01" max="2013-12-31"  value="{{ old('fecha') }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="hora">Hora</label>
                    <input type="time" class="form-control" name="hora" value="{{ old('hora') }}" required>
                </div>
                </div>
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}" required>
                </div>
                <div class="form-group">
                    <label for="temas[]">Temas</label>
                    <select class="custom-select" name="temas[]" id="temas" multiple>
                        <option selected>Selecciona un tema</option>
                        @foreach($temas as $tema)
                        <option value="{{ $tema->nombre }}">{{ $tema->nombre }}</option>
                        @endforeach()
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Crear Trámite</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection