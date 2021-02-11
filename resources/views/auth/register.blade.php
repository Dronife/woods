@extends('layouts.app')

@section('content')

<body style="background-image: linear-gradient(to right,#1f6fde, #6b1fde);">
    <div class=" row d-flex justify-content-md-center ">
        <div class="col-md-4 text-center p-3">
            <img style="width:20%; filter:invert(100%); " src="dist/img/registerSeed.png">
        </div>
    </div>
    <div class="row d-flex justify-content-md-center">

        <div class="col-md-4 ">
            <div class="card " style="background-color: rgba(255,255,255,0.8);">
                <div class="card-header h3">{{ __('Register') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        @include('auth.registerForm')
                        <div class="form-group">
                            
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Register') }}
                                </button>
                                <div class="text-center">
                                
                                    <br>
                                    <a class="btn btn-link" href="{{ route('login') }}">
                                            {{ __('You have one? Login!') }}
                                    </a>
                               </div>
                        
                        </div>
                    </form>
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection