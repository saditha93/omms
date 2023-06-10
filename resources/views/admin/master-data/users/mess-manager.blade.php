@extends('layouts.app')


@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Create Mess Manager
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <form method="GET" action="{{route('get-mess-manger-data')}}">
                    @csrf
                    <div class="row">

                        <div class="col-md-3 offset-md-8">
                            <div class="form-group">
                                <label for="officer_number" class="form-label">Officer Number</label>
                                <input placeholder="O/12345" type="text" class="form-control" name="officer_number" id="officer_number" value="">
                                @error('officer_number')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-1 mt-4 pt-2">
                            <div class="form-group">
                                <input class="btn btn-primary float-right" type="submit" value="Search">
                            </div>
                        </div>
                    </div>
                </form>

                <form method="POST" action="{{route('save-mess-manager-data')}}">
                    @csrf
                    <div class="row mt-5">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input readonly type="text" class="form-control" name="full_name" id="full_name" value="{{isset($dataCollections)?$dataCollections->person[0]->full_name:''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="e_number" class="form-label">E-Number</label>
                                <input readonly type="text" class="form-control" name="e_number" id="e_number" value="{{isset($dataCollections)?$dataCollections->person[0]->eno:''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="service_number" class="form-label">Service Number</label>
                                <input readonly type="text" class="form-control" name="service_number" id="service_number" value="{{isset($dataCollections)?$dataCollections->person[0]->service_no:''}}">
                                @error('service_number')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="rank" class="form-label">Rank</label>
                                <input readonly type="text" class="form-control" name="rank" id="rank" value="{{isset($dataCollections)?$dataCollections->person[0]->rank:''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name_acco_part2" class="form-label">Name According to Part2</label>
                                <input readonly type="text" class="form-control" name="name_acco_part2" id="name_acco_part2" value="{{isset($dataCollections)?$dataCollections->person[0]->name_according_to_part2:''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="regiment" class="form-label">Regiment</label>
                                <input readonly type="text" class="form-control" name="regiment" id="regiment" value="{{isset($dataCollections)?$dataCollections->person[0]->regiment:''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="unit" class="form-label">Unit</label>
                                <input readonly type="text" class="form-control" name="unit" id="unit" value="{{isset($dataCollections)?$dataCollections->person[0]->unit:''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nic" class="form-label">NIC</label>
                                <input readonly type="text" class="form-control" name="nic" id="nic" value="{{isset($dataCollections)?$dataCollections->person[0]->nic:''}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="estb" class="form-label">Establishment</label>
                                <select class="form-control" name="estb" id="estb">
                                    <option value="">Select Establishment</option>
                                    @foreach($establishments as $establishment)
                                        <option  value="{{$establishment->id}}">{{$establishment->establishment}} / {{$establishment->abbr}}</option>
                                    @endforeach
                                </select>
                                @error('estb')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="mess" class="form-label">Mess</label>
                                <select class="form-control" name="mess" id="mess">
                                    @if(isset($admin->mess_id))
                                        @foreach($userEstbbMesses as $userEstbbMess)
                                            <option value="{{$userEstbbMess->id}}">{{$userEstbbMess->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('mess')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group pl-4 mt-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" {{isset($admin->active)?$admin->active==1?'checked':'':'checked'}} type="checkbox" role="switch" id="admin_status" name="admin_status">
                                    <label class="form-check-label label-font-weight" for="availability">Account Active</label>
                                    <input type="hidden" id="active" name="active" value="{{isset($admin->active)?$admin->active==1?'1':'0':'1'}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary float-right mt-5">Add Mess Manager</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="cell-border" id="adminListDt"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th style="width: 50px">Serial</th>
                        <th>Name</th>
                        <th>E-Number</th>
                        <th>Status</th>
                        <th>Mess</th>
                        <th>Establishment</th>
                        <th>Activated at</th>
                        <th>deactivated at</th>
                        <th>Action1</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('#admin_status').click(function (){
            if( $('#admin_status').is(':checked') ){
                $("#active").val(1);
            }
            else
            {
                $("#active").val(0);
            }
        });

        //get messea
        $("#estb").change(function(){
            let establishmentId = this.value;

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                url: '{{route('establishment-messes')}}',
                type: 'POST',
                data: {establishmentId:establishmentId},
                success: function (data) {

                    $("#mess").find("option").remove();

                    if (data.length ===0)
                    {
                        $('#mess').append("<option value=''>No record available</option>");
                    }
                    else
                    {
                        for (let val in data) {

                            $('#mess').append("<option value='" + data[0,val].id + "'>" + data[0,val].name + "</option>");

                        }
                    }



                },
                error: function (error) {
                }
            });
        });

        adminList();

        function adminList()
        {
            //dtaTable
            $('#adminListDt').DataTable({
                serverSide: true,
                ajax: {
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '{{route("get-admins")}}',
                    type: "post",
                    dataType: "json",
                    rowId: 'id'
                },
                columns: [
                    {
                        "data": null, "render": function (data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'E-Number'},
                    {
                        "mRender": function (data, group, full, meta) {

                            $active = '<span class="badge rounded-pill bg-success">Active</span>';
                            $inactive = '<span class="badge rounded-pill bg-info">Inactive</span>';
                            return full.active==1?$active:$inactive;

                        }
                    },
                    {data: 'mess_name', name: 'mess_name'},
                    {data: 'establishment', name: 'establishment'},
                    {data: 'formatted_dob', name: 'formatted_dob'},
                    {data: 'deactivated_at', name: 'deactivated_at'},
                    {
                        "mRender": function (data, group, full, meta) {

                            $activate = '<button class="btn btn-primary btn-sm btn-mess-manager-active" href="" > Re-Active&nbsp; </button>';
                            $deactivate = '<button class="btn btn-danger btn-sm btn-mess-manager-deactive" href="" >Deactivate</button>';
                            return full.active==1?$deactivate:$activate;

                        }
                    },
                ]
            });

        }



        $(document).ready( function () {

            //deactivate
            $('#adminListDt').on('click', '.btn-mess-manager-deactive', function() {

                let messManagerId = $(this).closest('tr').attr('id');

                let text = "De-active this user?";
                if (confirm(text) == true) {

                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: 'json',
                        url: '{{route('deactivate-mess-manager')}}',
                        type: 'POST',
                        data: {messManagerId:messManagerId },
                        success: function (response) {
                            // alert('User De-Activated');
                            // location.reload();

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'User deactivated',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(function(){
                                location.reload()
                            }, 1500);
                        },
                    });
                }
            });


            //re active
            $('#adminListDt').on('click', '.btn-mess-manager-active', function() {

                let messManagerId = $(this).closest('tr').attr('id');

                let text = "Re active this user?";
                if (confirm(text) == true) {

                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: 'json',
                        url: '{{route('re-activate-mess-manager')}}',
                        type: 'POST',
                        data: {messManagerId:messManagerId },
                        success: function (response) {
                            // alert('User Re-Activated');
                            // location.reload();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'User activated',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(function(){
                                location.reload()
                            }, 1500);
                        },
                    });
                }
            });



        } );



    </script>
@endpush