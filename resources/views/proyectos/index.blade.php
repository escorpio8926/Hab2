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
	<h1>
		<i class="fa fa-btn fa-align-justify"></i> Proyectos
		<a class="btn btn-success pull-right" href="{{ route('proyectos.create') }}"><i class="fa fa-btn fa-plus"></i>Nuevo</a>
	</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="search">
			<form action="/admp/public/proyectos" method="GET" class="form-horizontal">
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









        </div>



    </div>

</div>



@endsection
