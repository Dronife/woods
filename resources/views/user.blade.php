

@extends('layouts.app')




@section('content')

<body style="background-color:#e4eaec"  >

   
        <div class="row  d-flex justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div>
                            <a href="{{url('/create-forest')}}" class="btn btn-primary">{{ __('Add Forest') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
</body>
@endsection
