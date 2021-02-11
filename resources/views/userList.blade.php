@extends('layouts.app')
@section('content')

<body style="background-color:#e4eaec">
@include('layouts.confirmDelete')
    <div class="pt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header ">{{ __('User List') }}</div>
                    <div class="card-body">

                        <form name="userList" action="{{url('/submit-user-list')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <table class="table table-bordered table-striped dataTable dtr-inline" id="myTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="display: none;">ID#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <!-- <th>Role</th> -->
                                        <th class="col">Change</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $user_role_index = -1;
                                    $Pass = false;
                                    $badge = "badge bg-warning"; ?>
                                    @foreach($users as $key => $user)

                                    <tr>
                                        <td style="display:none;">
                                            <div class="col-xs-1">
                                            @for($i = 0; $i < count($useroles) ; $i++) <?php
                                                                                        if ($useroles[$i]->user_id == $user->id) {
                                                                                            $user_role_index = $i;
                                                                                            $Pass = true;
                                                                                            switch ($useroles[$user_role_index]->name) {
                                                                                                case 'admin':
                                                                                                    $badge = "callout-warning";
                                                                                                    break;
                                                                                                case 'user':
                                                                                                    $badge = "callout-success";
                                                                                                    break;
                                                                                            }
                                                                                        }
                                                                                        ?> @endfor 
                                                <input name="userids[]" type="text" value="{{$user->id}}" class="form-control  " readonly>
                                            </div>
                                        </td>
                                        <td>
                                        <div class="pb-5" style="height: 20px;">
                                        <div class="callout {{$badge}} " >
                                            {{$user->name}}
                                         </div> 
                                        </div> 
                                        </td>
  
                                        <td>{{$user->email}}</td>

                                        
                                        <td>
                                            <select class="form-control" name="roleOptions[]" id="lol">
                                                @for($i = 0; $i < count($roles) ; $i++) <option <?php if ($roles[$i]->id == $useroles[$user_role_index]->id) echo  "selected"; ?> value="{{$roles[$i]->id}}">{{$roles[$i]->name}}</option>
                                                    @endfor
                                            </select>
                                        </td>
                                        <td><button style="width: 35px;" type="button" id="deleteButton" data-toggle="modal" data-target="#exampleModal" name="{{$user->id}}" class="btn btn-outline-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <input name="form1" type="submit" class="btn btn-success float-right">
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">

                    <div class="d-flex  card-header">
                        <div class=" mr-auto p-1">{{ __('Add Users') }}</div>

                    </div>

                    <div class="card-body">




                        <form name="adminRegister" action="{{ url('/admin-register-submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @include('auth.registerForm')
                            <div class="from-group">

                                <select class="form-control @error('SelectedRole') is-invalid @enderror" name="SelectedRole">
                                    <option value="">Select Role...</option>
                                    @for($i = 0; $i < count($roles) ; $i++) <option value="{{$roles[$i]->id}}">
                                        {{$roles[$i]->name}}
                                        </option>
                                        @endfor
                                </select>
                                @error('SelectedRole')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <br>
                            <div class="from-group">

                                <input name="form2" value="Register new user" type="submit" class="btn btn-primary float-right">
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('dist/js/deleteFunction.js')}}"></script>
    <script type="text/javascript">
        checkDelete("destroyUser/");
    </script>
</body>
@endsection