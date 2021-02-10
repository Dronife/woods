@extends('layouts.app')




@section('content')

<body style="background-color:#e4eaec">



    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

    @include('layouts.editForestModal')

    @include('layouts.confirmDelete')

    <div class="pt-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">{{ __('Submited Forests') }}</div>
                    <div class="card-body">

                        @include('layouts.filterSubmission')

                        <table class="table table-bordered table-striped dataTable dtr-inline" id="myTable">
                            <thead class="table-dark">
                                <tr>
                                    <!-- <th class="collapse multi-collapse" id="tableCollapse">Cell phone</th>
                                    <th class="collapse multi-collapse" id="tableCollapse">Email</th> -->
                                    <th>Area</th>
                                    <th>Type</th>
                                    <th>Maturity</th>
                                    <th>Price</th>
                                    <th>Pictures</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $picsForest_ID = -1;
                                $Pass = false;
                                $count = 0; ?>
                                @foreach($types as $key => $data)

                                <tr id="mainTable">
                                    <!-- <td >{{$data->email}}</td> -->
                                    <td>{{$data->area}}</td>
                                    <td>{{$data->typeid}}</td>
                                    <td>{{$data->ageid}}</td>
                                    <td><?php $price = ($data->price) / 1000;
                                        echo $price . "k"; ?></td>
                                    <td>
                                        @for($i = 0; $i < count($pictureCount) ; $i++) <?php
                                                                                    if ($pictureCount[$i]->forest_id == $data->id) {
                                                                                        $picsForest_ID = $i;
                                                                                    }

                                                                                    ?> @endfor @if($picsForest_ID !=-1) @if(($pictureCount[$picsForest_ID ]->count) > 0)
                                            <a href="{{ url('/slide-show/'.$data -> id) }}" type="button" class="btn btn-success btn-xs" type="button">View Pictures</a>

                                            @endif
                                            @else
                                            <span data-toggle="tooltip" class="badge bg-secondary">No Pictures</span>
                                            @endif

                                    </td>

                                    <td>
                                        <div class="row">

                                            <div class="btn-group" role="group">
                                                <button style="width: 35px;" href="javascript:;" data-toggle="modal" data-target=".bd-example-modal-sm" type="button" name="{{$data->id}}" id="editButton" class="btn btn-outline-primary btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                    </svg>
                                                </button>

                                                <button style="width: 35px;" type="button" id="deleteButton" data-toggle="modal" data-target="#exampleModal" name="{{$data->id}}" class="btn btn-outline-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                                <button style="width: 35px;" href="#tableCollapse{{$count}}" data-toggle="collapse" aria-controls="tableCollapse{{$count}}" aria-expanded="false" type="button" class="btn btn-outline-dark btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                <tr class="collapse multi-collapse" id="tableCollapse{{$count}}">
                                    <td colspan="6">
                                        <div class="collapse multi-collapse" id="tableCollapse{{$count}}">
                                            <table class="table table-striped" id="secondTable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Cell phone</th>
                                                        <th>Email</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <!-- <td>{{substr($data->surname,0,1).". ".$data->lastname }}</td> -->
                                                        <td>{{$data->surname." ".$data->lastname }}</td>
                                                        <td>{{$data->phone}}</td>
                                                        <td>{{$data->email}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </td>
                                </tr>

                                <?php
                                $picsForest_ID = -1;
                                $count++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('dist/js/admin.js')}}"></script>
    <script src="{{ asset('dist/js/deleteFunction.js')}}"></script>
    <script type="text/javascript">
        checkDelete("deleteSubmittion/");
    </script>

</body>
@endsection