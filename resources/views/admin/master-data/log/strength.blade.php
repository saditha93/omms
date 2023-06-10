@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Officer Strength Details
                <div class="pull-right">
                    <a class="btn btn-info btn-sm float-right" href="{{ route('home') }}"> Back</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="strengthDataTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Establishment</th>
                        <th>Registered Officers</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @if(Auth::user()->user_type ==1)
                        @foreach ($messes as $mess)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $mess->name }}</td>
                                <td>{{ $mess->str }}</td>
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
            $('#strengthDataTbl').DataTable();
        });
    </script>

@endpush

@push('page_css')
    <style>
        #strengthDataTbl_wrapper .dt-buttons{
            display: none !important;
        }
    </style>
@endpush
