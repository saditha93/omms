@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Items</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Items</li>
                            <li class="breadcrumb-item active">All</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div>

            <div class="card">

                <div class="card-header">
                    <div class="card-title">All</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>

                <form role="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-1 ml-2">
                        <div class="col-4">
                            <select class="form-control" name="category" id="category">
                                <option value="">Select Category</option>
                                @foreach ($categories as $item)
                                    @if($item->code != 'bar_item')
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>

                <div class="card-body">
                    <table class="table table-striped table-hover data-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Categories</th>
                            <th>Code</th>
                            <th>Measure Unit</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            @endsection

            @section('third_party_stylesheets')
                <link rel="stylesheet" href="{{ asset('plugin/flowbite/flowbite.min.css') }}"/>
                <link rel="stylesheet" href="{{ asset('plugin/MCDatepicker/mc-calendar.min.css') }}"/>
                <link rel="stylesheet" href="{{ asset('plugin/datatable/buttons.dataTables.min.css') }}">
                <link rel="stylesheet" href="{{ asset('plugin/datatable/dataTables.bootstrap4.min.css') }}">
                <link href="{{ asset('plugin/tree/treeview.css')}}" rel="stylesheet">
            @stop

            @section('third_party_scripts')
                <script src="{{ asset('plugin/flowbite/flowbite.js') }}"></script>
                <script src="{{ asset('plugin/datatable/jquery.validate.js') }}" defer></script>
                <script src="{{ asset('plugin/datatable/jquery.dataTables.min.js') }}" defer></script>
                <script src="{{ asset('plugin/datatable/bootstrap.min.js') }}" defer></script>
                <script src="{{ asset('plugin/datatable/dataTables.bootstrap4.min.js') }}" defer></script>
                <script src="{{ asset('plugin/datatable/dataTables.buttons.min.js') }}" defer></script>
                <script src="{{ asset('plugin/vendor/datatables/buttons.server-side.js') }}" defer></script>
                <script src="{{ asset('plugin/flowbite/datepicker.js') }}"></script>
                <script src="{{ asset('plugin/MCDatepicker/mc-calendar.min.js') }}"></script>
                <script src="{{ asset('plugin/tree/treeview.js')}}"></script>

                <script type="text/javascript">
                    $(function () {
                        var table = $('.data-table').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: {
                                url: "{{ route('stockItem.index') }}",
                                data: function (d) {
                                    d.category = $('#category').val()
                                }
                            },
                            columns: [
                                {data: 'index', name: 'index'},
                                {data: 'name', name: 'name'},
                                {data: 'categories', name: 'categories'},
                                {data: 'code', name: 'code'},
                                {data: 'measure_unit.name', name: 'measure_unit.name'},
                                {data: 'active', name: 'active'},
                                {data: 'action', name: 'action'},
                            ]
                        });

                        $('#category').change(function () {
                            table.draw();
                        });

                    });
                </script>
@stop
