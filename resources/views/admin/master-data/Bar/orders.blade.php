@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Bar Orders
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="officer" class="form-label">Respective Officers</label>
                            <select id="officer"
                                    class="select2-single form-control" name="officer">
                                <option value="">Select the name</option>
                                @foreach($officers as $officer)
                                    <option
                                        value="{{$officer->email}}">{{ $officer->name_according_to_part2 .' - '. $officer->service_no}}</option>
                                @endforeach
                            </select>
                            @error('officer')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="cell-border" id="barOrdersDt"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th style="width: 50px">Serial</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Item</th>
                        <th>Measure</th>
                        <th>Qty</th>
                        <th>Tentative Price</th>
                        <th>Order Date</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('plugin/flowbite/flowbite.min.css') }}"/>
    <script src="{{ asset('plugin/datatable/jquery.validate.js') }}" defer></script>
    <script src="{{ asset('plugin/datatable/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('plugin/datatable/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('plugin/datatable/dataTables.bootstrap4.min.js') }}" defer></script>
    <script src="{{ asset('plugin/datatable/dataTables.buttons.min.js') }}" defer></script>
    <script src="{{ asset('plugin/vendor/datatables/buttons.server-side.js') }}" defer></script>
@stop

@push('scripts')
    <script src="{{ asset('plugin/flowbite/flowbite.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('plugin/datatable/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugin/datatable/dataTables.bootstrap4.min.css') }}">
    <script>

        $(document).ready(function () {
            $('#officer').select2();
        });

        $(document).ready(function () {

            $('#officer').on('change', function () {
                $('#barOrdersDt').DataTable().destroy();
                officerBarOrders();
            });

            $('#officer').ready(function () {
                $('#barOrdersDt').DataTable().destroy();
                officerBarOrders();
            });

            function officerBarOrders() {

                let officer_id = $('#officer').val();

                $('#barOrdersDt').DataTable({
                    serverSide: true,
                    ajax: {
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '{{url("admin/officer-respective-bar-orders")}}',
                        type: "POST",
                        data: {officer_id: officer_id},
                        dataType: "json",
                    },
                    columns: [
                        {
                            "data": null, "render": function (data, type, full, meta) {
                                return meta.row + 1;
                            }
                        },
                        {data: 'name_according_to_part2', name: 'name_according_to_part2'},
                        {data: 'catName', name: 'catName'},
                        {data: 'itemName', name: 'itemName'},
                        {data: 'measureNAme', name: 'measureNAme'},
                        {data: 'qty', name: 'qty'},
                        {data: 'price', name: 'price'},
                        {data: 'order_dt', name: 'order_dt'},
                    ]
                });

            }

        });
    </script>

@endpush

