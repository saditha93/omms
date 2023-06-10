@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Tea Item Prices
            </div>
            <div class="card-body">
                @if(!isset($item->id))
                    <form method="POST" action="{{route('tea-items-price-set')}}">
                        @else
                    <form method="POST" action="{{route('tea-item-update',$item->id)}}">
                                @method('PUT')
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="item" class="form-label">Item</label>
                                            <select class="form-control" name="item" id="item" {{isset($item->item_id)?'disabled':''}}>
                                                <option value="">Select menu</option>
                                                @foreach($teaItems as $teaItem)
                                                    <option value="{{$teaItem->id}}"  {{isset($item->item_id)?$item->item_id==$teaItem->id?'selected':'':''}}>{{$teaItem->item_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('item')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="scale" class="form-label">Qty</label>
                                            <input type="text" class="form-control" name="scale" id="scale" value="{{isset($item->scale)?$item->scale:''}}">
                                            @error('scale')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="price" class="form-label">Price</label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-text" id="currency-input">RS</span>
                                                <input aria-describedby="currency-input" data-type="currency"  type="number" step="0.01" class="form-control" name="price" id="price" value="{{isset($item->price)?$item->price:old('price')}}">
                                            </div>
                                            @error('price')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group pl-4">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" {{isset($item->status)?$item->status==1?'checked':'' :'checked'}} type="checkbox" role="switch" id="menu_availability" name="menu_availability">
                                                <label class="form-check-label label-font-weight" for="availability">Menu Availability</label>
                                                <input type="hidden" id="status" name="status" value="{{isset($item->status)?$item->status==1?1:0:1}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(!isset($item->id))
                                                <input class="btn btn-primary float-right" type="submit" value="Add Tea Item Price">
                                            @else
                                                <input class="btn btn-primary float-right" type="submit" value="Update Tea Item Price">
                                                <a class="btn btn-secondary float-right mr-1" type="button" href="{{route('tea-items')}}">Cancel</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                    </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
{{--                {{ $dataTable->table() }}--}}
                <table id="allTeaItemsTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Index</th>
                        <th>Item Name</th>
                        <th>Item Price</th>
                        <th>Qty</th>
                        <th>Created at</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
{{--    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}--}}
    <script src="{{asset('/js/datepicker/datepicker.js')}}"></script>
    <script>

        $('#menu_availability').click(function (){
            if( $('#menu_availability').is(':checked') ){
                $("#status").val(1);
            }
            else
            {
                $("#status").val(0);
            }
        });


        //price input
        $( document ).ready(function() {
            formatUnitPrice();
            teaDatatable()
            $("input[data-type='currency']").on({
                keyup: function() {
                },
                blur: function() {
                    formatUnitPrice($(this), "blur");
                }
            });
        });
        function formatUnitPrice()
        {
            let inputVal = $('#price').val();
            let cry = Number(inputVal).toFixed(2);
            $('#price').val(cry);
        }



        //datatable
        function teaDatatable()
        {
            //dtaTable
            $('#allTeaItemsTbl').DataTable({
                // responsive: true,
                // processing: true,
                serverSide: true,
                ajax: {
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '{{url("admin/get-tea-items")}}',
                    type: "POST",
                    dataType: "json",
                },
                columns: [
                    {
                        "data": null, "render": function (data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {data: 'item_name', name: 'item_name'},
                    {
                        "mRender": function (data, group, full, meta) {
                            return full.price.toFixed(2);
                        }
                    },
                    {data: 'scale', name: 'scale'},
                    {data: 'date', name: 'date'},
                    {
                        "mRender": function (data, group, full, meta) {

                            let yes = '<span class="badge rounded-pill bg-success">Yes</span>';
                            let no = '<span class="badge rounded-pill bg-danger">No</span>';
                            if(full.status==1)
                            {
                                return yes;
                            }
                            else
                            {
                                return no;
                            }
                        }
                    },
                    {data: 'action', name: 'action'},

                ]
            });



        }


    </script>
@endpush
@push('page_css')
    <style>
        #allTeaItemsTbl_wrapper .dt-buttons{
            display: none !important;
        }

    </style>
@endpush

