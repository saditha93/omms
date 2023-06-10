@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Add Members
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <form method="POST" action="{{route('get-Officer-data')}}">
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

                <form method="POST" action="{{route('save-Officer-data')}}">
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary float-right mt-5 ">Add Officer to the Mess</button>
                            </div>
                        </div>
                    </div>
                </form>

                {{--<form method="POST" action="{{route('save-Officer-data-bulk')}}">--}}
                {{--@csrf--}}
                    {{--<div class="col-md-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<button type="submit" class="btn btn-primary float-right mt-5 ">Add Officer Bulk</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}

            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <label for="regiment" class="form-label">Registered Messes</label>
            </div>
            <div class="card-body">
                @if(isset($userRegMess))
                    @foreach($userRegMess as $mess)
                        @if(isset($mess->name))
                            <li>{{$mess->name}} - {{$mess->establishment}}</li>
                        @else
                            <li>No records found</li>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="officerTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>E Number</th>
                        <th>Regiment</th>
                        <th>Unit</th>
                        <th>Assigned Dt</th>
                        <th>Deactivated Dt</th>
                        <th>Status</th>
                        <th width="110px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($officers))
                        @foreach ($officers as $officer)
                            <tr id="{{$officer->id}}">
                                <td>{{ $officer->service_no }}</td>
                                <td>{{ $officer->rank }}</td>
                                <td>{{ $officer->name_according_to_part2 }}</td>
                                <td>{{ $officer->email }}</td>
                                <td>{{ $officer->regiment }}</td>
                                <td>{{ $officer->unit }}</td>
                                <td>{{ $officer->assigned_date }}</td>
                                <td>{{ $officer->deactivated_date }}</td>
                                <td>{{ ($officer->status==1)?'Active':'Inactive' }}</td>
                                <td>
                                    @if($officer->status==1)
                                        <button class="btn btn-danger btn-sm btn-user-deactive" href="" >Deactivate</button>
                                    @else
                                        <button class="btn btn-primary btn-sm btn-user-active" href="" > Re-Active&nbsp; </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                    <tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        $(document).ready(function () {
            $('#officerTbl').DataTable();

            //de-active
            $('#officerTbl .btn-user-deactive').on('click', function () {

                let userId = $(this).closest('tr').attr('id');

                let text = "Deactivate this user?";
                if (confirm(text) == true) {

                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: 'json',
                        url: '{{route('user-inactive')}}',
                        type: 'POST',
                        data: {userId:userId },
                        success: function (response) {
                            // alert('User deactivated');

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

                            // location.reload();
                        },
                    });
                }
            });

            //re-active
            $('#officerTbl .btn-user-active').on('click', function () {

                let userId = $(this).closest('tr').attr('id');

                let text = "Re active this user?";
                if (confirm(text) == true) {

                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: 'json',
                        url: '{{route('user-active')}}',
                        type: 'POST',
                        data: {userId:userId },
                        success: function (response) {
                            // alert('User Activated');
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

        });

        $('#admin_status').click(function (){
            if( $('#admin_status').is(':checked') ){
                $("#active").val(1);
            }
            else
            {
                $("#active").val(0);
            }
        });

    </script>
@endpush


@push('page_css')
    <style>
        #officerTbl_wrapper .dt-buttons{
            display: none !important;
        }

    </style>
@endpush