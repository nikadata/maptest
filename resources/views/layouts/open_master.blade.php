<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Maprom InserTool</title>

        <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Datatables bootstrap -->
<link rel="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.2/b-html5-1.5.2/fh-3.1.4/datatables.min.css"/>
        <!-- Fontawesame CSS -->
<!--<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script> -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<!-- Char.js -->
<link rel="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js">
<!-- Loading gif -->
<style>
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 }
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom {
  from{ bottom:-100px; opacity:0 }
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
  text-align: center;
}
</style>
    </head>
    <body>
      <!-- Start Top Bar -->
        <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="https://maprom.se">Maprom Statistics</a>
    <a class="navbar-link" href="{{ route('home') }}">Admin <i class="fas fa-lock"></i>&nbsp&nbsp&nbsp</a>
    <a class="navbar-link" href="{{ route('report') }}">Home <i class="fas fa-home"></i>&nbsp&nbsp&nbsp</a>
    <a class="navbar-link" href="{{ route('statistics') }}">Update <i class="fas fa-chart-bar"></i>&nbsp&nbsp&nbsp</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <!-- Fiscal tables -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Test Fiscal
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{ route('open_fiscal') }}">1. Fiscal data</a>
        </div>
      </li>
      <!-- End Fiscal -->
      <!-- Distict tables -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Districts <!--<span class="badge badge-primary badge-pill">New</span>-->
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{ route('open_table_district') }}">1. Extended versus singel family per district</a>
            <a class="dropdown-item" href="{{ route('ilfov') }}">2. Ilfov: Roms per Village</a>
            <a class="dropdown-item" href="{{ route('dambovita') }}">3. Dambovita: Roms per Village</a>
        </div>
      </li>
      <!-- End Districts -->
      <!-- Popolation tables -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Population <!--<span class="badge badge-primary badge-pill">New</span>-->
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{ route('standard') }}">1. Standard population table</a>
          <a class="dropdown-item" href="{{ route('standard_ilfov') }}">2. Standard population table <strong>Ilfov</strong></a>
          <a class="dropdown-item" href="{{ route('standard_dambovita') }}">3. Standard population table <strong>Dambovita</strong></a>
          <a class="dropdown-item" href="{{ route('agepyramid') }}">4. Age population table</a>
          <a class="dropdown-item" href="{{ route('agepyramid_ilfov') }}">5. Age population table <strong>Ilfov</strong></a>
          <a class="dropdown-item" href="{{ route('agepyramid_dambovita') }}">6. Age population table <strong>Dambovita</strong></a>
        </div>
      </li>
      <!-- End Population -->
      <!-- Skill tables -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Skill <!--<span class="badge badge-primary badge-pill">New</span>-->
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{ route('open_cat_table_skill') }}">1. Socio-economic stratification</a>
          <a class="dropdown-item" href="{{ route('ilfov_cat_table_skill') }}">2. Socio-economic stratification of Ilfov</a>
          <a class="dropdown-item" href="{{ route('dambovita_cat_table_skill') }}">3. Socio-economic stratification of Dambovita</a>
          <a class="dropdown-item" href="{{ route('open_table_skill') }}">4. Number of Roms per skill(job)</a>
        </div>
      </li>
      <!-- End Skills -->
      <!-- Social tables -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Social
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{ route('open_social') }}">1. Social data</a>
        </div>
      </li>
      <!-- End Social -->
      <!-- Villages -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Villages
        </a>
        <!-- Remove route to statsrom 2. Villages->Roms -->
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{ route('stats') }}">1. Households per village</a>
          <a class="dropdown-item" href="{{ route('statsrom') }}">2. Number of Roms per village</a>
          <a class="dropdown-item" href="{{ route('open_table_roms') }}">3. Size of Romani households per village</a>
          <a class="dropdown-item" href="{{ route('plai') }}">4. Villages in Plai</a>
          <a class="dropdown-item" href="{{ route('plasa') }}">5. Villages in Plasă</a>
          <a class="dropdown-item" href="{{ route('statsland') }}">6. Land area m2</a>
        </div>
      </li>
      <!-- End Villages -->
      <!-- Tables -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tables
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{ route('open_table_nation') }}">1. Number of Roms per nationality</a>
        <!--  <a class="dropdown-item" href="{{ route('open_table_rom') }}">2. Number of Roms per village</a>-->
          <a class="dropdown-item" href="{{ route('table_age') }}">2. Age distribution</a>

        </div>
      </li>
    </ul>
  </div>
</nav>
</div>
<br>
        <div class="container">
            @yield('content')
        </div>
        <!--Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.2/b-html5-1.5.2/fh-3.1.4/datatables.min.js"></script>
<!-- -->

<script src=//cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js charset=utf-8></script>
<script src=//cdn.jsdelivr.net/npm/fusioncharts@3.12.2/fusioncharts.js charset=utf-8></script>
<script src=//cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>

@stack('scripts')

    </body>
</html>
