@extends('layouts.app')

@section('content')
<body style="background-image: linear-gradient(to right,#159957, #155799);" >
    <!-- <div class="jumbotron vertical-center" style="background-color: rgba(0,0,0,0);"></div> -->
    <div class=" row d-flex justify-content-md-center ">
        <div class="col-md-4 text-center p-3">
            <img   style="width:20%; filter:invert(100%); " src="dist/img/loginTree.png">
        </div>
    </div>
    <div class="row d-flex justify-content-md-center" >
       
        <div class="col-md-4 ">
            <div class="card " style="background-color: rgba(255,255,255,0.8);">
                <div class="card-header h3">{{ __('Login') }}</div>

                <div class="card-body"  >
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        @include('auth.loginForm')
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
