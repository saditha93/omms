@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                User Login Details
                <div class="pull-right">
                    <a class="btn btn-info btn-sm float-right" href="{{ route('home') }}"> Back</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="loginDataTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Officer</th>
                        <th>Mess</th>
                        <th>Establishment</th>
                        <th>Last Login</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @if(Auth::user()->user_type ==1)
                    @foreach ($userIds as $userId)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $userId->data->name }}</td>
                            <td>{{ $userId->data->mess }}</td>
                            <td>{{ $userId->data->establishment }}</td>
                            <td>{{ $userId->data->created_at }}</td>
                        </tr>
                    @endforeach
                    @endif
                    <tbody>
                </table>

            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script>
        $(document).ready(function () {

            $('#loginDataTbl').DataTable();
        });
    </script>

@endpush

@push('page_css')
    <style>
        #loginDataTbl_wrapper .dt-buttons{
            display: none !important;
        }

    </style>
@endpush
