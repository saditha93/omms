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
                Create Mess System Users
            </div>
            <div class="card-body">
                <div class="pull-right">
                    <a class="btn btn-info btn-sm" href="{{ route('users.index') }}"> Back</a>
                </div>
            </div>
        </div>
    </div>



    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{route('get-system-user-data')}}">
                    @csrf
                    <div class="row">

                        <div class="col-md-3 offset-md-8">
                            <div class="form-group">
                                <label for="service_number" class="form-label">Service Number</label>
                                <input placeholder="O/12345" type="text" class="form-control" name="service_number" id="service_number" value="">
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
            </div>
            <div class="card-body">


                <form method="POST" action="{{route('save-system-user-data')}}">
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

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group pl-4 mt-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" {{isset($admin->active)?$admin->active==1?'checked':'':'checked'}} type="checkbox" role="switch" id="admin_status" name="admin_status">
                                    <label class="form-check-label label-font-weight" for="availability">Account Active</label>
                                    <input type="hidden" id="active" name="active" value="{{isset($admin->active)?$admin->active==1?'1':'0':'1'}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <strong>Role</strong>
                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                        </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary float-right mt-5">Add System User</button>
                            </div>
                        </div>
                    </div>
                </form>

                {{--{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-6">--}}
                        {{--<div class="form-group">--}}
                            {{--<strong>Name</strong>--}}
                            {{--{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6">--}}
                        {{--<div class="form-group">--}}
                            {{--<strong>Email</strong>--}}
                            {{--{!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6">--}}
                        {{--<div class="form-group">--}}
                            {{--<strong>Password</strong>--}}
                            {{--{!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6">--}}
                        {{--<div class="form-group">--}}
                            {{--<strong>Confirm Password</strong>--}}
                            {{--{!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="col-xs-12 col-sm-12 col-md-6">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="estb" class="form-label">User type</label>--}}
                            {{--<select class="form-control" name="user_type" id="user_type">--}}
                                {{--<option value="">Select user type</option>--}}
                                {{--@foreach($userTypes as $userType)--}}
                                    {{--<option value="{{$userType->id}}">{{$userType->user_type}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
                        {{--<div class="form-group pl-4 mt-4">--}}
                            {{--<div class="form-check form-switch">--}}
                                {{--<input class="form-check-input" {{isset($admin->active)?$admin->active==1?'checked':'':'checked'}} checked type="checkbox" role="switch" id="admin_status" name="admin_status">--}}
                                {{--<label class="form-check-label label-font-weight" for="availability">Account Active</label>--}}
                                {{--<input type="hidden" id="active" name="active" value="1">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<strong>User Type</strong>--}}
                            {{--{!! Form::select('userType[]', $userTypes,[], array('class' => 'form-control','multiple')) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<strong>Role</strong>--}}
                            {{--{!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="col-xs-12 col-sm-12 col-md-12 text-center">--}}
                        {{--<button type="submit" class="btn btn-primary float-right btn-sm">Submit</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--{!! Form::close() !!}--}}

            </div>
        </div>
    </div>

@endsection

@push('scripts')

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
</script>
 @endpush