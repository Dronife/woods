@extends('layouts.app')
@section('content')

<body style='background-color:#1f2021;'>

    <div class=" position-sticky ">
        <a class="carousel-control-prev pt-5" href="{{ url()->previous() }}" role="button">

            <svg xmlns="http://www.w3.org/2000/svg" width="20%" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
            </svg>
        </a>
    </div>



    <div class="  modal-dialog modal-lg">
        <div class="modal-content" style="background-color:#1f2021;">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">

                    <?php $first = true;  ?>
                    @foreach($pics as $key => $data)
                    @if($first)
                    <div class="carousel-item active">
                        @else
                        <div class="carousel-item">
                            @endif
                            @if($data->dir != null)
                            <img class="d-block w-50" src="{{asset($data->dir)}}">
                            
                            @endif
                            
                        </div>
                        <div class="row d-flex justify-content-md-center ">
                            <div class="position-absolute">
                                <div class="card  text-center d-inline-flex p-2 bg-dark text-white" style="background-color: rgba(255,255,255,0.8); ">
                                    <div class="card-header">Settings</div>
                                    <div class="card-body  text-center">
                                        <div class="row">
                                            <a class="btn btn-danger mr-3">Delete</a>
                                            <a class="btn btn-success ml-3">Upload</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php $first = false; ?>
                        @endforeach
                        
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">{{'Previous'}}</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">{{'Next'}}</span>
                    </a>

                </div>
            </div>
        </div>

    </div>




</body>
@endsection