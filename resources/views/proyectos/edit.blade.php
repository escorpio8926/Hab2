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


<div class="page-header">
	<h1><i class="fa fa-edit"></i> Proyectos / Editar #{{$proyecto->id}}</h1>
</div>
@include('common.error')

<div class="row">
	<div class="col-md-12">

		<form action="{{ route('proyectos.update', $proyecto->id) }}" method="POST">
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form-group @if($errors->has('titulo')) has-error @endif">
				<label for="titulo-field">Titulo</label>
				<input type="text" id="titulo-field" name="titulo" class="form-control" value="{{ $proyecto->titulo }}"/>
				@if($errors->has("titulo"))
				<span class="help-block">{{ $errors->first("titulo") }}</span>
				@endif
			</div>
			<div class="form-group @if($errors->has('descripcion')) has-error @endif">
				<label for="descripcion-field">Descripcion</label>
				<textarea class="form-control" id="descripcion-field" rows="3" name="descripcion">{{ $proyecto->descripcion }}</textarea>
				@if($errors->has("descripcion"))
				<span class="help-block">{{ $errors->first("descripcion") }}</span>
				@endif
			</div>
			<div class="well well-sm">
				<button type="submit" class="btn btn-primary">Save</button>
				<a class="btn btn-link pull-right" href="{{ route('proyectos.index') }}"><i class="fa fa-btn fa-backward"></i>  Back</a>
			</div>
		</form>
	</div>
</div>
@endsection
