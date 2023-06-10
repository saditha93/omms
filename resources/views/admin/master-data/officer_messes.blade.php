@extends('layouts.app')


@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Messes Details
                <div class="pull-right">
                    <a class="btn btn-info btn-sm float-right" href="{{ route('home') }}"> Back</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="offsrTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Establishment</th>
                        <th>Mess</th>
                        <th>Location</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @foreach ($messes as $mess)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $mess->establishment }}</td>
                            <td>{{ $mess->name }}</td>
                            <td>{{ $mess->location }}</td>
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

            $('#offsrTbl').DataTable();

        });
    </script>

@endpush

@push('page_css')
    <style>
        #offsrTbl_wrapper .dt-buttons{
            display: none !important;
        }

    </style>
@endpush
