@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> {{ $user->name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">{{ $user->name }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">View User</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Name</label>
                        <div class="col-sm-9">
                            <span>{{$user->name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="email">E Number</label>
                        <div class="col-sm-9">
                            <span>{{$user->email}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="active">Role</label>
                        <div class="col-sm-5 input-group">
                            @if( $user->userTypes->user_type == 'mess-manager')
                                <label class="badge badge-success">Mess Manager</label>
                            @elseif(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="active">Status</label>
                        <div class="col-sm-5 input-group">
                            @if($user->active == 1)
                                <mark class="px-2 text-white bg-green-600 rounded dark:bg-green-500">active</mark>
                            @else
                                <mark class="px-2 text-white bg-danger rounded dark:bg-danger">deactivate</mark>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
        @endsection

        @section('third_party_stylesheets')
            <link rel="stylesheet" href="{{ asset('plugin/flowbite/flowbite.min.css') }}"/>
            <link rel="stylesheet" href="{{ asset('plugin/MCDatepicker/mc-calendar.min.css') }}"/>
        @stop

        @section('third_party_scripts')
            <script src="{{ asset('plugin/flowbite/datepicker.js') }}"></script>
            <script src="{{ asset('plugin/MCDatepicker/mc-calendar.min.js') }}"></script>
            <script src="{{ asset('plugin/flowbite/flowbite.js') }}"></script>
@stop


