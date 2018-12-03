@extends('layouts.app')
@section('body-class','landing-page')
@section('content')
@section('title','Gestor de Poryecto')
@section('styles')
<style>

.team.row.col-md-4{
  margin-bottom: 5em;
}
.row {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display:         flex;
  flex-wrap: wrap;
}
.row > [class*='col-'] {
  display: flex;
  flex-direction: column;
}

</style>

@endsection
<div class="wrapper">
  <div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
      <div class="container">
          <div class="row">
    <div class="col-md-6">
      <h1 class="title">COSCOPIA</h1>
                <h4>Administra tus Proyectos de la manera mas facil y eficaz posible</h4>
                <br />
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-danger btn-raised btn-lg">
        <i class="fa fa-play"></i> Mira el Video
      </a>
    </div>
          </div>
      </div>
  </div>

<div class="main main-raised">
<div class="container">
    <div class="section text-center section-landing">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="title">¿Por que Coscopia?</h2>
                    <h5 class="description">Crea y Personaliza tu Tu diagrama</h5>
                </div>
            </div>

    <div class="features">
      <div class="row">
                  <div class="col-md-4">
          <div class="info">
            <div class="icon icon-primary">
              <i class="material-icons">chat</i>
            </div>
            <h4 class="info-title">Atencion Personalizada</h4>
            <p>Resolvemos todas tus dudas de manera online , para que puedas estar sin inquietudes , no dudes en consultarnos.</p>
          </div>
                  </div>
                  <div class="col-md-4">
          <div class="info">
            <div class="icon icon-success">
              <i class="material-icons">verified_user</i>
            </div>
            <h4 class="info-title">Pago Seguro</h4>
            <p>Permisos garantizados para tener tus proyectos controlados</p>
          </div>
                  </div>
                  <div class="col-md-4">
          <div class="info">
            <div class="icon icon-danger">
              <i class="material-icons">fingerprint</i>
            </div>
            <h4 class="info-title">Privacidad</h4>
            <p>Seguridad de Extremo a Extremo utlizando la ultima tecnologia</p>
          </div>
                  </div>
              </div>
    </div>
        </div>




      <div class="section landing-section">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="text-center title">¿Aun no te has Registrado?</h2>
        <h4 class="text-center description">Registrate Utlizando tus datos basicos y podras Realizar tu pedido a traves de nuestro Carrito compras. Si aun no te decides de todas formas con tu cuenta podras hacer todas tus consultas sin compromiso</h4>
                    <form class="contact-form">
                        <div class="row">
                            <div class="col-md-6">
              <div class="form-group label-floating">
                <label class="control-label">Tu nombre</label>
                <input type="email" class="form-control">
              </div>
                            </div>
                        <div class="col-md-6">
              <div class="form-group label-floating">
                <label class="control-label">Tu Email</label>
                <input type="email" class="form-control">
              </div>
                            </div>
                        </div>

          <div class="form-group label-floating">
            <label class="control-label">Tu mensaje</label>
            <textarea class="form-control" rows="4"></textarea>
          </div>

                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 text-center">
                                <button class="btn btn-primary btn-raised">
                Enviar mensaje
              </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

@include('includes.footer')
@endsection
