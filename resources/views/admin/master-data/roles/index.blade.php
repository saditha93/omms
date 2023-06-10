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
                Role Management
            </div>
            <div class="card-body">
                <div class="pull-right">
                    <a class="btn btn-success btn-sm" href="{{ route('roles.create') }}"> Create New Role</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="roleTbl" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th width="110px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    <tbody>
                </table>
                {!! $roles->render() !!}
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script>
        $(document).ready(function () {

            $('#roleTbl').DataTable();

        });
    </script>

@endpush

@push('page_css')
    <style>
        #roleTbl_wrapper .dt-buttons{
            display: none !important;
        }

    </style>
@endpush