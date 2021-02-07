@extends('layouts.app')
@section('content')
<div class="pt-5">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">

                <div class="d-flex  card-header">
                    <div class=" mr-auto p-1">{{ __('Change user data') }}</div>
                    <div class="collapse multi-collapse" id="collapsediv">
                    <div class=" p-1 ">
                        <button type="button" class="btn  btn-outline-secondary btn-sm" data-toggle="collapse" href="#collapsediv" role="button" aria-expanded="false" aria-controls="collapsediv">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"></path>
                            </svg>
                            <span class="visually-hidden"></span>
                        </button>
                    </div>
                    </div>
                </div>
                <div class="collapse multi-collapse show" id="collapsediv">
                <div class="card-body">

                    <form name="adminRegister" action="{{ url('/update-general-account') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input id="username" value="{{$user->username}}" placeholder="Username" type="text" class="form-control @error('name') is-invalid @enderror" name="username">

                           
                        </div>
                        <div class="form-group">
                            <input id="email" value="{{$user->email}}" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                         
                        </div>
                        <div class="form-group">
                            <input id="password" placeholder="Enter a Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="from-group">

                            <input name="form2" value="Update user " type="submit" class="btn btn-primary float-right">
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="pt-5">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">

                <div class="d-flex  card-header">
                    <div class=" mr-auto p-1">{{ __('Change password') }}</div>
                    <div class="collapse multi-collapse show" id="collapsediv">
                    <div class=" p-1">
                        <button type="button" class="btn  btn-outline-secondary btn-sm" data-toggle="collapse" href="#collapsediv" role="button" aria-expanded="false" aria-controls="collapsediv">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"></path>
                            </svg>
                            <span class="visually-hidden"></span>
                        </button>
                    </div>
                    </div>
                </div>
                <div class="collapse multi-collapse" id="collapsediv">
                <div class="card-body">

                    <form name="adminRegister" action="{{ url('/update-password-account') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <input id="password1" placeholder="Old password" type="password" class="form-control @error('password1') is-invalid @enderror" name="password1" required autocomplete="new-password">
                            @error('password1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="newpassword" placeholder="Enter new Password" type="password" class="form-control @error('newpassword') is-invalid @enderror" name="newpassword" required autocomplete="new-password">

                            @error('newpassword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="repeatpassword" placeholder="Repeat new Password" type="password" class="form-control @error('repeatpassword') is-invalid @enderror" name="repeatpassword" required autocomplete="new-password">

                            @error('repeatpassword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="from-group">

                            <input name="form1" value="Update Password " type="submit" class="btn btn-primary float-right">
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection