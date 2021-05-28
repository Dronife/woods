@extends('layouts.app')
@section('content')

<body class="container-fluid" style=" background-image: linear-gradient(to right,#0f0c29, #302b63,#24243e);">
    <div class="container w3-animate-left">
        <div class="row justify-content-center">
            <div class="col-sm-10">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    

                    <div class="card-body p-0">
                        <div class="row">
                        <div class="col-lg-6 d-none d-lg-block"><img style="width:100%;" src="{{ url('dist/img/createWoods.png') }}"></div>
                            <div class="col-lg-6">
                                <div class=" p-4">
                                <div class="text-center ">
                                    <h1 class="h4 text-gray mb-5">-Add Forest-</h1>
                                </div>
                            <form action="{{ url('/forest/submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                

                                    <div id="myModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                          
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Irasykite identifikacijos numeri</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <input name="idnr" type="text" name="" class="form-control input_user" value="" placeholder="Identifikacijos numeris"><br>
                                                </div>
                                                <div class="modal-footer">
                                                    <input action="operacija2.php" type="submit" value="Patvirtinti" class="btn btn-success" id="confirmBTN">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Uzdaryti</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                   @include('forestLayout')

                                    
                                        <label class="btn btn-primary btn-user btn-block">
                                            <i class="fa fa-image"></i> Upload pictures<input style="display: none;" id="nuotrauka" type="file" name="select_file[]" multiple accept=".jpg, .png, .jpeg">
                                        </label>
                                    

                                    
                                <input type="submit" value="Submit" class="btn btn-success btn-user btn-block" id="loginBTN">
                                   
                            </form>
                            </div>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>

</body>
@endsection