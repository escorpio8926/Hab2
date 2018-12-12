@extends('layouts.main')
@section('main')
<div class="page-header">
	<h1>{{$proyecto->titulo}}</h1>
	<form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Estas seguro de Eliminar?')) { return true } else {return false };">
		<input type="hidden" name="_method" value="DELETE">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="btn-group pull-right" role="group" aria-label="...">
			<a class="btn btn-warning btn-group" role="group" href="{{ route('proyectos.edit', $proyecto->id) }}" title="Editar Proyecto"><i class="fa fa-edit"></i></a>
			<button type="submit" class="btn btn-danger" title="Eliminar Proyecto"><i class="fa fa-trash"></i></button>
		</div>
	</form>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label for="descripcion">DESCRIPCION</label>
			<p class="form-control-static">{{$proyecto->descripcion}}</p>
		</div>
	</div>
</div>
@include('proyectos.listaActividades', ['actividades' => $proyecto->actividades])
<div class="row">
	<a class="btn btn-link" href="{{ route('proyectos.index') }}"><i class="fa fa-btn fa-backward"></i>Volver</a>
</div>
@endsection
