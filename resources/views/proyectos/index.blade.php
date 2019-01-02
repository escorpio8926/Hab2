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
	<h2>
		<i class="fa fa-btn fa-align-justify"></i> Proyectos
		<a class="btn btn-success pull-right" href="{{ route('proyectos.create') }}"><i class="fa fa-btn fa-plus"></i>Nuevo</a>
	</h2>
</div>

		<div class="search">
			<form action="/proyectos" method="GET" class="form-horizontal">
				<div class="form-group">
					<div class="input-group col-sm-offset-1 col-sm-10">
						<input type="text" name="buscar" id="buscar" class="form-control" value="{{ request()->buscar }}" placeholder="buscar Proyecto">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit"><i class="fa fa-btn fa-search"></i>buscar</button>
						</span>
					</div>
				</div>
			</form>
		</div>


		@if($pro->count())
	<div class="list-group">
			@foreach($pro as $proyecto)
      @foreach($pra as $prayecto)
      @if($proyecto->proyecto_id == $prayecto->id)
			<a href="{{ route('proyectos.show', $proyecto->id) }}" class="list-group-item">
        <h4 class="list-group-item-heading">{{$prayecto->titulo}} <span class="badge">{{$prayecto->actividades->count()}}</span></h4>
      <p class="list-group-item-text">{{$prayecto->descripcion}}</p>
    </a>
      @endif
			@endforeach
      @endforeach
    </div>
		@else
		<h3 class="text-center alert alert-info">No Hay Proyectos!</h3>
		@endif
		<br>
	<h2>
		<i class="fa fa-btn fa-align-justify"></i> Actividades compartidas conmigo
</h2>


@if(sizeof($permisos)>0)
      <table class="table table-striped">
        <thead>
        </thead>
        <tbody>
          @foreach ($permisos as $permiso)
          <tr>
            <td class="table-text">
						<a class="list-group-item">
              <form class="modificar" action="/proyectos/{{App\Actividade::findOrFail($permiso->id_actividad)->proyecto->id}}/actividade/{{$permiso->id_actividad}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
								<h4 class="list-group-item-heading">{{App\Actividade::find($permiso->id_actividad)->actividad}} <?php
								if( $permiso->controltotal==1){
									?>
								<span class="badge" style="background-color: #009020;">Control Total</span>

									<?php
								}else{
									if( $permiso->escribir==1){
										?>
										<span class="badge" style="background-color: #ff9000;">Lectura y Escritura</span>

											<?php
									}else{
										if( $permiso->leer==1){
											?>
											<span class="badge" style="background-color: #ff9000;">Lectura</span>

												<?php
										}else{
											?>
											<span class="badge" style="background-color: red;">Acceso Denegado</span>

												<?php
									}

								}
							}


								?></h4>
      <p class="list-group-item-text">{{"Dentro del proyecto:"}} <i>{{App\Proyecto::find(App\Actividade::find($permiso->id_actividad)->proyecto_id)->titulo}}</i>"</p>
                  <button type="submit" class="checkbox">Ver Actividad</button>
              </form>
							</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <h3>No Hay Actividades compartidas contigo</h3>
      @endif







@endsection
