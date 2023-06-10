@extends('layouts.app')


@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Establishment Details
                <div class="pull-right">
                    <a class="btn btn-info btn-sm float-right" href="{{ route('home') }}"> Back</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="estbTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Abbreviation</th>
                    </tr>
                    </thead>
                    <tbody>
                   <?php $i = 0; ?>
                    @foreach ($establishments as $establishment)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $establishment->establishment }}</td>
                            <td>{{ $establishment->abbr }}</td>
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

            $('#estbTbl').DataTable();

        });
    </script>

@endpush


@push('page_css')
    <style>
        #estbTbl_wrapper .dt-buttons{
            display: none !important;
        }

    </style>
@endpush
