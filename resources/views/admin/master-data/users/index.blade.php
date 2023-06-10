@extends('layouts.app')


@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Create Admins
            </div>
            <div class="card-body">
                <div class="pull-right">
                    <a class="btn btn-success btn-sm" href="{{ route('users.create') }}"> Create New User</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="userTbl" class="display" style="width:100%">
                   <thead>
                   <tr>
                       <th>No</th>
                       <th>Name</th>
                       <th>E Number</th>
                       <th>Activated at</th>
                       <th>deactivated at</th>
                       <th>Roles</th>
                       <th width="130px">Action</th>
                   </tr>
                   </thead>
                    <tbody>
                    @foreach ($data as $key => $user)
                        <tr id="{{$user->id}}">
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->deactivated_at }}</td>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                {{--{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}--}}
                                {{--{!! Form::submit('Deactivate', ['class' => 'btn btn-danger btn-sm']) !!}--}}
                                {{--{!! Form::close() !!}--}}
                                @if($user->active == 0)
                                    <button class="btn btn-primary btn-sm btn-staff-active"> Re-Active&nbsp; </button>
                                    @else
                                    <button class="btn btn-danger btn-sm btn-staff-deactive">Deactivate</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $data->render() !!}

            </div>
        </div>
    </div>


    {{--<div class="col-md-12">--}}
        {{--<div class="card">--}}
            {{--<div class="card-body">--}}
                {{--{{ $dataTable->table() }}--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

@push('scripts')

    <script>
        $(document).ready(function () {

            $('#userTbl').DataTable();




            //deactivate
            $('#userTbl').on('click', '.btn-staff-deactive', function() {

                let staffId = $(this).closest('tr').attr('id');

                let text = "De-active this user?";
                if (confirm(text) == true) {

                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: 'json',
                        url: '{{route('staff-deactivate')}}',
                        type: 'POST',
                        data: {staffId:staffId },
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
            $('#userTbl').on('click', '.btn-staff-active', function() {

                let staffId = $(this).closest('tr').attr('id');

                let text = "Re active this user?";
                if (confirm(text) == true) {

                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: 'json',
                        url: '{{route('activate-staff-user')}}',
                        type: 'POST',
                        data: {staffId:staffId },
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

        });
    </script>

@endpush

@push('page_css')
    <style>
        #userTbl_wrapper .dt-buttons{
            display: none !important;
        }

    </style>
@endpush