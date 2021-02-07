@extends('layouts.app')

@section('content')
<body style="background-image: linear-gradient(to right,#159957, #155799);" >
    <div class="jumbotron vertical-center" style="background-color: rgba(0,0,0,0);"></div>
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

                        <div class="form-group">

                            <div class="form-group">
                                <input placeholder="Enter Username..." id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            

                            <div class="form-group">
                                <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="form-group">
                            <div class="form-group">
                                <button 
                                type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Login') }}
                                </button>


                               <div class="text-center">
                                   <br>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                    <br>
                                    <a class="btn btn-link" href="{{ route('register') }}">
                                            {{ __('Create one!') }}
                                    </a>
                               </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
