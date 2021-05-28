@extends('layouts.app')
@section('content')
<div class="pt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">

                <div class="d-flex  card-header">
                Please fill identification number of your submited forest
                </div>
                <div class="body-card">
                <form name="adminRegister" action="{{ url('/forest/identification_Number/'.$forest_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        
                            <div class="p-5">
                            <input minlength="14" maxlength="14" required oninvalid="setCustomValidity('Wrong format')" class="form-control" name="idnum" placeholder="XXXX-XXXX-XXXX" type="text">
                            <div class=" d-flex">
                                <div class="ml-auto p-1 pt-2"><input type="submit" value="Submit" class="btn btn-success"></div>
                            </div>
                            </div>
                            {{$forest_id}}
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection