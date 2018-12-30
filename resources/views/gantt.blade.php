<!DOCTYPE html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">

    <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    <link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">

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
    <script src="http://export.dhtmlx.com/gantt/api.js"></script>  
    <script>
function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');
    var is_chrome = Boolean(mywindow.chrome);
    mywindow.document.write('<html><head>');
    mywindow.document.write('<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />');
    mywindow.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" /><scr');
    mywindow.document.write('ipt src="http://export.dhtmlx.com/gantt/api.js"></scri'); 
    mywindow.document.write('pt> <scr');
    mywindow.document.write('ipt src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></scr');
    mywindow.document.write('ipt><link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet"><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

   if (is_chrome) {
     setTimeout(function() { // wait until all resources loaded 
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10
        mywindow.print(); // change window to winPrint
        mywindow.close(); // change window to winPrint
     }, 1000);
   } else {
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();
   }

    return true;

    return true;
}
    </script>
	<!-- CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">   <title></title>
</head>
<body>
<?php

$permiso = App\Permiso::where('id_usuario','=',"".Auth::id())
->where('id_actividad','=',$idActividade)->get();
if( (sizeof($permiso)==0)){
    die("Acceso Denegado");
}
$permiso = $permiso[0];
if ($permiso->leer==0){
    die("Acceso Denegado");
}
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">{{$actividad->actividad}}</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Archivo<span class="caret"></span></a>
          <ul class="dropdown-menu">

            <li><a href="#" onclick='PrintElem("gantt_here")'>Imprimir</a></li>
            <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Exportar</a>
                            <ul class="dropdown-menu">
                            <li onclick='gantt.exportToPDF()'><a href="#" >PDF</a></li>
            <li onclick='gantt.exportToPNG()'><a href="#" >PNG</a></li>
            <li onclick='gantt.exportToExcel()'><a href="#" >Excel</a></li>
                                </ul>
                                </li>


           
            <li><a href="../" >Salir</a></li>
          </ul>
        </li>
        <?php
        if($permiso->controltotal==1){
        ?>
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Compartir<span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a target="_blank" style="cursor: pointer;" onclick="var mywindow = window.open('{{$idActividade}}/usuarios', 'PRINT', 'height=400,width=600');" >Manejar Permisos de Usuarios</a></li>
            </ul>
        </li>
  <?php
        }
        ?>

      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>



<div id="gantt_here" style='width:100%; height:100%;'></div>
<script type="text/javascript">

gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
<?php
if ($permiso->escribir==0){
    print("gantt.config.readonly = true;");
}
?>
gantt.init("gantt_here");                         //Aqui cargamos La API
gantt.load("/api/data/{{$idActividade}}");

var dp = new gantt.dataProcessor("/api");
dp.init(gantt);
dp.setTransactionMode("REST");

</script>
</body>
<script src="{{ asset ('/js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset ('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset ('/js/material.min.js') }}"></script>
