<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}'} </script>
        <title>Pagina Inicial</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="https://getbootstrap.com/docs/4.4/examples/dashboard/dashboard.css" > -->
        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        <link rel="stylesheet" href="{{ asset('css/lte.css') }}">
        
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    </head>
    <body>
      <div id="app">
          
              <navbar></navbar>
              <div class="clearfix"></div>
              <div class="container-fluid d-flex justify-content-center bg-muted">
                  <div class="row">
                  <div class="row">
        <div class="col-lg-12 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>Consultas</h3>

              <p><br></p>
            </div>
            <div class="icon">
            <ion-icon class="text-white"  name="clipboard"></ion-icon>            </div>
            <a href="/consultas" class="small-box-footer">Ver Consultas <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-12 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>Pacientes</h3>

              <p><br></p>
            </div>
            <div class="icon">
            <ion-icon  class="text-white" name="contacts"></ion-icon>            </div>
            <a href="/pacientes" class="small-box-footer">Ver Pacientes <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-12 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>Medicos</h3>
              <p><br></p>

            </div>
            <div class="icon">
            <ion-icon class="text-white" name="medkit"></ion-icon>            </div>
            <a href="/medicos" class="small-box-footer">Ver Medicos <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-12 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>Clinicas</h3>

              <p><br></p>
            </div>
            <div class="icon">
            <ion-icon class="text-white" name="business"></ion-icon>            </div>
            <a href="/clinicas" class="small-box-footer">Ver clinicas <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
                  </div>    
          </div>        
      </div>
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <script src="{{ asset('js/app.js') }}"></script>
      <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>

    </body>

</html>
