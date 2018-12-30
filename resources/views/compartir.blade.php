<!DOCTYPE html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>Usuarios con acceso</title>
    <script src="{{ asset ('/js/jquery.min.js') }}" type="text/javascript"></script>
    
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <style type="text/css">
        html, body{
            height:100%;
            padding:0px;
            margin:0px;
            overflow: hidden;
        }

       .dropdown-submenu {
    position: relative;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
    display: block;
}

.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
    border-left-color: #fff;
}

.dropdown-submenu.pull-left {
    float: none;
}

.dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
}

    </style>
    <!-- Latest compiled and minified CSS -->
	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
   

	<!-- CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">   <title></title>
   
</head>
<body>

<h3>&nbsp;Usuarios con acceso</h3>
<br>
<?php

  $permisos = App\Permiso::where('id_actividad','=',$idActividade)->get();
  $usuarios = [];

  ?>
<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Usuario</th>
        <th scope="col">Lectura</th>
        <th scope="col">Escritura</th>
        <th scope="col">Control Total</th>
        <th scope="col">Operaciones</th>

      </tr>
      </thead>
        <tbody>

      <?php
        foreach($permisos as $valor){
            array_push($usuarios,$valor->id_usuario);
            if($valor->id_usuario!=Auth::id()){
            ?>
            <tr>
                <td>{{$valor->usuario->name}}</td>
                <td onclick="window.location.href='usuarios/leer/{{$valor->id}}'"><input  type="checkbox" data-size="mini" data-onstyle="success" data-offstyle="danger" {{($valor->leer)==1?'checked':''}} data-toggle="toggle"></td>
                <td onclick="window.location.href='usuarios/escribir/{{$valor->id}}'"><input  type="checkbox" data-size="mini" data-onstyle="success" data-offstyle="danger" {{($valor->escribir)==1?'checked':''}} data-toggle="toggle"></td>
                <td onclick="window.location.href='usuarios/controltotal/{{$valor->id}}'"><input  type="checkbox" data-size="mini" data-onstyle="success" data-offstyle="danger" {{($valor->controltotal)==1?'checked':''}} data-toggle="toggle"></td>
                <td><button onclick="window.location.href='usuarios/eliminar/{{$valor->id}}'" type="button" class="btn btn-danger btn-xs">Eliminar</button></td>
                <td></td>

            </tr>

        <?php } } ?>
   
    </tbody>

</table>

<hr>
<div  style="padding: 10px"> 
<div class="form-group">
<h4>Agregar Usuario</h4>
  <form action="usuarios/agregar/0" >
  <select class="form-control" name="usuario">
  <option value="0">Elija un usuario</option>
  <?php
    $listatodosusuarios = App\User::all();
    
    foreach($listatodosusuarios as $usuario){

    if(($usuario->id!=Auth::user()->id)&&(!in_array($usuario->id, $usuarios) )){
  ?>
    <option value="{{$usuario->id}}">{{$usuario->name}}</option>

 
  
 <?php
    }
 }
 ?>
  </select>
</div>
<input type="submit"  class="btn btn-primary btn-xs" value="Agregar Usuario"></form>
</div>

</body>

<script src="{{ asset ('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset ('/js/material.min.js') }}"></script>
