@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Add Menu Item
            </div>
            <div class="card-body">
                @if(!isset($item->id))
                    <form method="POST" action="{{route('item.store')}}">
                        @else
                            <form method="POST" action="{{route('item.update',$item->id)}}">
                                @method('PUT')
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="category" class="form-label">Category:</label>
                                            <select class="form-control" name="category_id" id="category_id">
                                                @foreach($itemCategories as $itemCategory)
                                                    <option value="{{$itemCategory->id}}" {{isset($item->category_id)?$item->category_id==$itemCategory->id?'selected':'' :''}}>{{$itemCategory->category_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="item_name" class="form-label">Item Name</label>
                                            <input type="text" class="form-control" name="item_name" id="item_name"
                                                   value="{{isset($item->item_name)?$item->item_name:old('item_name')}}">
                                            @error('item_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="item_code" class="form-label">Item Code</label>
                                            <input class="d-none form-control" id="hiddenItemNumber"
                                                   value="{{isset($code)?$code:$numberPiese}}">
                                            <input type="text" disabled class="form-control text-right" name="item_code"
                                                   id="item_code"
                                                   value="{{isset($item->item_code)?$item->item_code:$code}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group pl-4">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input"
                                                       {{isset($item->status)?$item->status==1?'checked':'' :'checked'}} type="checkbox"
                                                       role="switch" id="availability" name="availability">
                                                <label class="form-check-label label-font-weight" for="availability">Item
                                                    Availability</label>
                                                <input type="hidden" id="status" name="status"
                                                       value="{{isset($item->status)?$item->status==1?1:0:1}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(!isset($item->id))
                                                <input class="btn btn-primary float-right" type="submit"
                                                       value="Add Item">
                                            @else
                                                <input class="btn btn-primary float-right" type="submit"
                                                       value="Update Item">
                                                <a class="btn btn-secondary float-right mr-1" type="button"
                                                   href="{{route('item.index')}}">Cancel</a>

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
                {{--{{ $dataTable->table() }}--}}
                <table id="itemsTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Index</th>
                        <th>Category</th>
                        <th>Item Name</th>
                        <th>Status</th>
                        <th width="100px">Action</th>
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

        $( document ).ready(function() {
            itemDatatable();
        });

        $('#availability').click(function () {
            if ($('#availability').is(':checked')) {
                $("#status").val(1);
            }
            else {
                $("#status").val(0);
            }
        });

        //set item code
        $('#category_id').on('change', function () {
            generateCode()

        });
        $('#item_name').on('keyup', function () {
            generateCode()
        });

        function generateCode() {

            let itemCategory = $("#category_id option:selected").text();
            let itemName = $('#item_name').val().split(" ").join("-");
            let itemNumber = $('#hiddenItemNumber').val();

            itemCategory = itemCategory.toLowerCase();
            itemName = itemName.toLowerCase();

            $('#item_code').val(itemCategory + '-' + itemName + '-' + itemNumber);
        }


        //datatable
        function itemDatatable()
        {
            //dtaTable
            $('#itemsTbl').DataTable({
                // responsive: true,
                // processing: true,
                serverSide: true,
                ajax: {
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '{{url("admin/get-menu-items")}}',
                    type: "POST",
                    dataType: "json",
                },
                rowId: 'id',
                columns: [
                    {
                        "data": null, "render": function (data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {data: 'category_name', name: 'category_name'},
                    {data: 'item_name', name: 'item_name'},
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
        #itemsTbl_wrapper .dt-buttons{
            display: none !important;
        }

    </style>
@endpush