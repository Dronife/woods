<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header">{{ __('Edit sumbition') }}</div>
                    <div class="card-body">
                        <form name="userList" action="{{url('/forest/update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input name="forestid" id="userid" type="text" value="" class="form-control " readonly><br>
                            @include('forestLayout')
                            <div class="d-flex">
                                <div class=" ml-auto p-1">
                                    <input name="submitEdit" type="submit" value="Update" class="btn btn-success " id="updateButton">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>