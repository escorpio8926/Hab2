@extends('layouts.app')
@section('body-class','product-page')
@section('content')
@section('title','Principal | Gantt Online')
<div class="wrapper">
  <div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">

  </div>

<div class="main main-raised">
<div class="container">


      <div class="section ">
            <h2 class="title text-center">Proyectos Online</h2>
            @if (session('notification'))
            <div class="alert alert-success">
                    {{ session('notification') }}
            </div>
            @endif

            <ul class="nav nav-pills nav-pills-primary" role="tablist">

              <div class="page-header clearfix">
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
