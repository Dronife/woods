<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet"  href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet"  href="{{asset('css/test.css')}}" type="text/css">
  <!-- Ionicons -->
  <link rel="stylesheet"  href="{{asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet"  href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet"  href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet"  href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet"  href="{{asset('dist/css/adminlte.min.css')}}">

  <!-- overlayScrollbars -->
  <link rel="stylesheet"  href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet"  href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet"  href="{{asset('plugins/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet"  href="{{asset('dist/css/w3.css')}}">
  <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js')}}"></script>

  <!-- Google Font: Source Sans Pro -->
  <link  href="{{asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700')}}" rel="stylesheet">



</head>


  @auth()
  <body class="w3-animate-left" style="background-image: linear-gradient(#475463,#616f80);"> 
    <!-- @if (\Request::is('slide-show/*}'))   -->
    <!-- dark -->
    <!-- @else -->
      <!-- <body class="w3-animate-left" style="background-color:#e4eaec">  -->
    <!-- @endif -->
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand col-md-1" href="{{ url('/adminpanel') }}">
        <!-- {{ config('app.name', 'Laravel') }} -->
        <img style="width:50%; filter:invert(100%); " src="{{asset('dist/img/loginTree.png')}}">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav pl-5 ">
         
            <li class="nav-item">
              <a class="nav-link" href="{{url('/create-forest')}}">Add Forest</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/users')}}">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/configuration')}}">Configuration</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="{{url('/contacs/2800')}}">Contacts</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="{{url('/about')}}">About</a>
            </li>

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->

          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}
            </a>
            
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ url('/account') }}">
                                                                Account
              </a>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
              </a>
            </div>
          </li>
        </ul>



      </div>
    </div>
  </nav>
  @else
  <body class="w3-animate-left">
  @endauth


  <div id="app">
    <main class="py-4">
      @yield('content')
    </main>
  </div>

  <!-- jQuery -->

  <script src="{{ asset( 'plugins/jquery/jquery.min.js' ) }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <!-- <script>
  $.widget.bridge('uibutton', $.ui.button)
</script> -->
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('plugins/sparklines/sparkline.js')}}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
  <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Summernote -->
  <script src="{{ asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('dist/js/pages/dashboard.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js')}}"></script>
</body>

</html>