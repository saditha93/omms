@extends('layouts.app')


@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Admin Password Change
                <div class="pull-right">
                    <a class="btn btn-info btn-sm float-right" href="{{ route('home') }}"> Back</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('reset-admin-password')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label>Name</label>
                            <input readonly class="form-control" type="text" value="{{isset($adminInfo[0]->name)?$adminInfo[0]->name:''}}">
                        </div>
                        <div class="col-md-4">
                            <label>E Number</label>
                            <input readonly class="form-control" type="text" value="{{isset($adminInfo[0]->email)?$adminInfo[0]->email:''}}">
                        </div>
                        @if(isset($adminInfo[0]->messName))
                        <div class="col-md-4">
                            <label>Mess</label>
                            <input readonly class="form-control" type="text" value="{{isset($adminInfo[0]->messName)?$adminInfo[0]->messName:''}}">
                        </div>
                        @endif
                        <div class="col-md-12 mb-5">
                            <h5 class="text-success">Instruction for creating new password</h5>
                            <ul class="text-maroon">
                                <li>The new password must contain 8 characters.</li>
                                <li>The new password must contain at least one uppercase and one lowercase letter. [A, a,..]</li>
                                <li>The new password must contain at least one symbol. [/, *,..]</li>
                                <li>The new password must contain at least one number. [1, 2,..]</li>
                            </ul>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" class="form-control" name="current_password" id="current_password">
                            @error('current_password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" name="new_password" id="new_password">
                            @error('new_password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                            @error('confirm_password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <input class="btn btn-primary float-right" type="submit" value="Change Password">
                        </div>
                    </div>
                </form>
            </div>
            {{--reset password--}}
        </div>
    </div>


    @if(isset($admins))
        @if(Auth::user()->user_type ==1 || Auth::user()->user_type==2)
            <div class="col-md-12 mt-4">
                <div class="card">
            <div class="card-header">
                User Password Reset
            </div>
            <div class="card-body">
            <form method="POST" action="{{route('reset-system-admins-password')}}">
                @csrf
                <div class="row">

                    <div class="col-md-4 form-group">
                        <label for="user">User</label>
                        <select aria-hidden="true" id="user" class="form-control" name="user">
                            <option value="">Select Mess Manager</option>
                            @foreach($admins as $admin)
                                <option value="{{ $admin->id }}">{{ $admin->name }} - {{ $admin->abbr }} / {{ $admin->messName }}</option>
                            @endforeach
                        </select>
                        @error('user')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="reset_new_password">New Password</label>
                        <input type="password" class="form-control" name="reset_new_password" id="reset_new_password">
                        @error('reset_new_password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="reset_confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" name="reset_confirm_password" id="reset_confirm_password">
                        @error('reset_confirm_password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <input class="btn btn-primary float-right" type="submit" value="Reset Password">
                    </div>
                </div>
            </form>
        </div>
        </div>
            </div>
        @endif
    @endif

@endsection

@push('scripts')

    <script>
        $(document).ready(function () {

            $('#adminUsersTbl').DataTable();

        });
    </script>

@endpush
