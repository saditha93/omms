@extends('layouts.app')


@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Mess Managers Details
                <div class="pull-right">
                    <a class="btn btn-info btn-sm float-right" href="{{ route('home') }}"> Back</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="adminUsersTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>E Number</th>
                        <th>Mess</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>

                    @foreach ($admins as $admin)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->messName }}</td>
                        </tr>
                    @endforeach
                    <tbody>
                </table>

            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script>
        $(document).ready(function () {

            $('#adminUsersTbl').DataTable();

        });
    </script>

@endpush

@push('page_css')
    <style>
        #adminUsersTbl_wrapper .dt-buttons{
            display: none !important;
        }

    </style>
@endpush
