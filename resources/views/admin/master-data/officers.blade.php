@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Officers Details
                <div class="pull-right">
                    <a class="btn btn-info btn-sm float-right" href="{{ route('home') }}"> Back</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="officersTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Service No</th>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>E Number</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>

                    @foreach ($officers as $officer)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $officer->service_no }}</td>
                            <td>{{ $officer->rank }}</td>
                            <td>{{ $officer->name_according_to_part2 }}</td>
                            <td>{{ $officer->email }}</td>
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

            $('#officersTbl').DataTable();

        });
    </script>

@endpush

@push('page_css')
    <style>
        #officersTbl_wrapper .dt-buttons{
            display: none !important;
        }

    </style>
@endpush
