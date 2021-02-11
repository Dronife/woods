@extends('layouts.app')
@section('content')
<div class="pt-5">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">

                <div class="d-flex  card-header">
                    <h5><b> Create default elements</b></h5>
                </div>
                <div class="card-body justify-content-center">
                    <div class="row">
                        <div class="col text-center m-3">
                        <form action="{{url('/configCreateDefaults')}}"method="POST" enctype="multipart/form-data">
                                    @csrf
                            <input type="submit" name="typeForm" class="btn btn-success btn-block" value="Create forest types" @if($typesCount > 0) disabled @endif>
                        </form>
                        </div>
                    </div>
                    
                    <div class="row">
                    <div class="col text-center m-3">
                    <form action="{{url('/configCreateDefaults')}}"method="POST" enctype="multipart/form-data">
                                    @csrf
                            <input type="submit" name="ageForm" class="btn btn-success btn-block " value="Create forest maturity" @if($agesCount > 0) disabled @endif>
                        </form>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col text-center m-3">
                    <form action="{{url('/configCreateDefaults')}}"method="POST" enctype="multipart/form-data">
                                    @csrf
                            <input type="submit" name=roleForm class="btn btn-success btn-block" value="Create user roles" @if($roleCount > 0) disabled @endif>
                        </form>
                    </div>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</div>

@endsection