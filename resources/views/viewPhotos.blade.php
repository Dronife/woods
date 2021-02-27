@extends('layouts.app')
@section('content')

<head>
    <style>
        .hovereffect {
            width: 100%;
            height: 100%;
            float: left;
            overflow: hidden;
            position: relative;
            text-align: center;
            cursor: default;
        }

        .hovereffect .overlay {
            width: 100%;
            height: 100%;
            position: absolute;
            overflow: hidden;
            top: 0;
            left: 0;
            opacity: 0;
            background-color: rgba(0, 0, 0, 0.5);
            -webkit-transition: all .4s ease-in-out;
            transition: all .4s ease-in-out
        }

        .hovereffect img {
            display: block;
            position: relative;
            -webkit-transition: all .4s linear;
            transition: all .4s linear;
            object-fit: cover
        }

        .hovereffect h2 {
            text-transform: uppercase;
            color: #fff;
            text-align: center;
            position: relative;
            font-size: 17px;
            background: rgba(0, 0, 0, 0.6);
            -webkit-transform: translatey(-100px);
            -ms-transform: translatey(-100px);
            transform: translatey(-100px);
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
            padding: 10px;
        }

        .hovereffect a.info,
        a.delete {
            text-decoration: none;
            display: inline-block;
            text-transform: uppercase;
            color: #fff;
            border: 1px solid #fff;
            background-color: transparent;
            opacity: 0;
            filter: alpha(opacity=0);
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
            margin: 50px 0 0;
            padding: 7px 14px;
        }

        .hovereffect a.info:hover,
        a.delete:hover {
            box-shadow: 0 0 5px #fff;
        }

        .hovereffect:hover img {
            -ms-transform: scale(1.2);
            -webkit-transform: scale(1.2);
            transform: scale(1.2);
        }

        .hovereffect:hover .overlay {
            opacity: 1;
            filter: alpha(opacity=100);
        }



        .hovereffect:hover a.info .hovereffect:hover a.delete {
            -webkit-transition-delay: .2s;
            transition-delay: .2s;
        }
    </style>
</head>
<!-- style='background-color:#1f2021;' -->

<body>

    <div class="pl-5" style="position: sticky;top: 150px;">
        <a class="btn btn-outline-light btn-xs" href="{{ url('/login') }}" role="button" style=" border: 0px solid black;">
    
            <svg xmlns="http://www.w3.org/2000/svg" width="50px" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
            </svg>
        </a>
    </div>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg  modal-dialog-centered">
    <div class="modal-content">
     <img id="myImage" src="#">
    </div>
  </div>
</div>

    @include('layouts.confirmDelete')







    <div class=" container pt-5">
        <div class="row ">
            @if($pictureCount != 0)
            @for($i=0; $i< $pictureCount; $i++) <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="border border-dark rounded  pb-3" style="overflow: hidden; background-color:rgba(52, 58, 64,0.35);">
                    <div class="p-3">
                        <div class="hovereffect">
                            <img class="img-responsive shadow " src="{{asset($pics[$i]->dir)}}" alt="" style="width: 350px; height: 350px;">
                            <div class="overlay">
                                <div class="pt-5">
                                    <div class="row justify-content-center p-5">

                                        <button id="viewPhotoButton" type="button" class="btn  btn-outline-light btn-lx" name="{{asset($pics[$i]->dir)}}"  data-toggle="modal" data-target=".bd-example-modal-lg">View Picture</button>
                                    </div>
                                    <div class="row justify-content-center p-5">
                                        <button class="btn  btn-outline-danger btn-lx" name="{{$pics[$i]->id}}" type="button" id="deleteButton" data-toggle="modal" data-target="#exampleModal">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
        </div>



        @endfor
        @endif
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="border border-dark rounded pb-3" style="overflow: hidden; background-color:rgba(52, 58, 64,0.35);">
                <div class="p-3">
                    <div class="hovereffect">
                        <div class="row justify-content-center pt-5" style="width: 350px; height: 350px;">
                            <div class="square centerd pt-5">
                                <form action="{{ url('/pictures/add/'.$id.'/'.True) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label class=" btn  btn-outline-success btn-lx shadow-lg p-3 bg-dark" href="#submitImage" type="button" data-toggle="collapse" aria-controls="submitImage" aria-expanded="false">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
                                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0z" />
                                        </svg>
                                        <div>
                                            Add picture
                                            <input style="display: none;" id="nuotrauka" type="file" name="select_file[]" multiple accept=".jpg, .png, .jpeg">
                                        </div>

                                    </label>
                                    <div class="collapse multi-collapse" id="submitImage">
                                        <div class="d-flex pb-5 pt-5 ">
                                            <div class="mr-auto p-1">
                                                <button class="btn btn-sm  btn-outline-light  shadow-lg p-1"> Submit</button>
                                            </div>
                                            <div class=" p-1">
                                                <button href="#submitImage" type="button" data-toggle="collapse" aria-controls="submitImage" aria-expanded="false" class="btn btn-sm btn-outline-danger shadow-lg p-1"> Cancle</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <script src="{{ asset('dist/js/deleteFunction.js')}}"></script>
    <script type="text/javascript">
            checkDelete("/pictures/delete/");
        $(document).ready(function (){
            $('button').click(function() {

            if ($(this).attr('id') == "viewPhotoButton") {
                var url = $(this).attr('name');
                 $("#myImage").attr("src",url);
            }

            });
        });
    </script>
</body>
@endsection