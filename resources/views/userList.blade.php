@extends('layouts.app')
@section('content')

<body style="background-color:#e4eaec">

    <div class="pt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header ">{{ __('User List') }}</div>
                    <div class="card-body">

                        <form name="userList" action="{{url('/submit-user-list')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <table class="table table-bordered table-striped dataTable dtr-inline" id="myTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th class="col">Change</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $user_role_index = -1;
                                    $Pass = false;
                                    $badge = "badge bg-warning"; ?>
                                    @foreach($users as $key => $user)

                                    <tr>
                                        <td>
                                            <div class="col-xs-1">
                                                
                                                <input name="userids[]" type="text" value="{{$user->id}}" class="form-control " readonly>
                                            </div>
                                        </td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>

                                        <td class="text-center">
                                            @for($i = 0; $i < count($useroles) ; $i++) <?php
                                                                                        if ($useroles[$i]->user_id == $user->id) {
                                                                                            $user_role_index = $i;
                                                                                            $Pass = true;
                                                                                            switch ($useroles[$user_role_index]->name) {
                                                                                                case 'admin':
                                                                                                    $badge = "badge bg-danger";
                                                                                                    break;
                                                                                                case 'user':
                                                                                                    $badge = "badge bg-success";
                                                                                                    break;
                                                                                            }
                                                                                        }
                                                                                        ?> @endfor @if($Pass) <span data-toggle="tooltip" class="{{$badge}}">{{$useroles[$user_role_index]->name}}</span>
                                                @else
                                                <span data-toggle="tooltip" class="badge bg-secondary">No Role</span>
                                                @endif
                                        </td>
                                        <td>
                                            <select class="form-control" name="roleOptions[]" id="lol">
                                                @for($i = 0; $i < count($roles) ; $i++) <option <?php if ($roles[$i]->id == $useroles[$user_role_index]->id) echo  "selected"; ?> value="{{$roles[$i]->id}}">{{$roles[$i]->name}}</option>
                                                    @endfor
                                            </select>
                                        </td>
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
                                
                            <select class="form-control @error('SelectedRole') is-invalid @enderror" name="SelectedRole" >
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


</body>
@endsection