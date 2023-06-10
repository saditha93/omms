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
                Update Admin
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
                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name</strong>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>E Number</strong>
                            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control','readonly')) !!}
                        </div>
                    </div>
                    {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<strong>Password</strong>--}}
                            {{--{!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
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
                                    {{--<option value="{{$userType->id}}" {{isset($user->user_type)?$user->user_type==$userType->id?'selected':'':''}}>{{$userType->user_type}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group pl-4 mt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" {{isset($user->active)?$user->active==1?'checked':'':'checked'}}  type="checkbox" role="switch" id="admin_status" name="admin_status">
                                <label class="form-check-label label-font-weight" for="availability">Account Active {{$user->active}}</label>
                                <input type="hidden" id="active" name="active" value="{{isset($user->active)?$user->active==1?'1':'0':'1'}} ">
                            </div>
                        </div>
                    </div>
                    {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="mess_id" class="form-label">Mess: </label>--}}
                            {{--<select class="form-control" name="mess_id" id="mess_id">--}}
                                {{--@foreach($messes as $mess)--}}
                                    {{--<option value="{{$mess->id}}" {{isset($userMess[0]->id)?$mess->id==$userMess[0]->id?'selected':'':''}}>{{$mess->name}} / {{$mess->location}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Role</strong>
                            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary float-right btn-sm">Submit</button>
                    </div>
                </div>
                {!! Form::close() !!}
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