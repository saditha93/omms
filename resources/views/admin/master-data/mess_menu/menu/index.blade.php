@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Create Menus
            </div>
            <div class="card-body">
                @if(!isset($menu->id))
                    <form method="POST" action="{{route('menu.store')}}">
                        @else
                            <form method="POST" action="{{route('menu.update',$menu->id)}}">
                                @method('PUT')
                                @endif
                                @csrf
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="menu_name" class="form-label">Menu Name</label>
                                            <input type="text" class="form-control" name="menu_name" id="menu_name"
                                                   value="{{isset($menu->menu_name)?$menu->menu_name:old('menu_name')}}">
                                            @error('menu_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="menu_code" class="form-label">Menu Code</label>
                                            <div class="input-group">
                                                <input class="d-none form-control" id="hiddenMenuNumber"
                                                       value="{{isset($code)?$code:$numberPies}}">
                                                <input type="text" class="form-control w-50 text-right" name="menu_code"
                                                       id="menu_code"
                                                       value="{{isset($menu->menu_code)?$menu->menu_code:$code}}"
                                                       disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="meal_type" class="form-label">Meal Type</label>
                                            <select class="form-control" name="meal_type" id="meal_type">
                                                <option value="">Select meal type</option>
                                                <option value="1" selected {{isset($menu->meal_type)?$menu->meal_type=='1'?'selected':'':''}}>Non-vegetarian </option>
                                                {{--<option value="0" {{isset($menu->meal_type)?$menu->meal_type=='0'?'selected':'':''}}>vegetarian </option>--}}
                                            </select>
                                            @error('meal_type')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="remarks" class="form-label">Remarks</label>
                                        <input type="text" class="form-control" name="remarks" id="remarks"
                                               value="{{isset($menu->remarks)?$menu->remarks:''}}">
                                    </div>



                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="menu_items" class="form-label">Menu Items</label>
                                            <select aria-hidden="true" id="menu_items"
                                                    class="multiple-select form-control" name="menu_items[]"
                                                    multiple="multiple">

                                                @foreach($items as $item)
                                                    <option value="{{$item->id}}" {{isset($returnIdArray)?in_array($item->id, $returnIdArray)?'selected':'':''}}>{{ $item->item_name }}</option>
                                                @endforeach

                                            </select>
                                            @error('menu_items')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group pl-4">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input"
                                                       {{isset($menu->status)?$menu->status==1?'checked':'' :'checked'}} type="checkbox"
                                                       role="switch" id="menu_availability" name="menu_availability">
                                                <label class="form-check-label label-font-weight" for="availability">Menu
                                                    Availability</label>
                                                <input type="hidden" id="status" name="status"
                                                       value="{{isset($menu->status)?$menu->status==1?1:0:1}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(!isset($menu->id))
                                                <input class="btn btn-primary float-right" type="submit"
                                                       value="Generate menu">
                                            @else
                                                <input class="btn btn-primary float-right" type="submit"
                                                       value="Update Menu">
                                                <a class="btn btn-secondary float-right mr-1" type="button"
                                                   href="{{route('menu.index')}}">Cancel</a>

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
                {{ $dataTable->table() }}
                {{--<table id="menuListTbl" class="display" style="width:100%">--}}
                    {{--<thead>--}}
                    {{--<tr>--}}
                        {{--<th>Index</th>--}}
                        {{--<th>Menu Name</th>--}}
                        {{--<th>Meal Type</th>--}}
                        {{--<th>Status</th>--}}
                        {{--<th>Menu Item</th>--}}
                        {{--<th width="100px">Action</th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}

                    {{--</tbody>--}}
                {{--</table>--}}
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
{{--<script src="{{asset('/js/datepicker/datepicker.js')}}"></script>--}}

    <script>



        $(document).ready(function () {
            $('.multiple-select').select2({});
            // menuDatatable();
        });


        $('#menu_availability').click(function () {
            if ($('#menu_availability').is(':checked')) {
                $("#status").val(1);
            }
            else {
                $("#status").val(0);
            }
        });


        //set meal type to code
        $('#menu_type').on('change', function () {
            // var menu = $(this).val();
            generateCode()
        });
        $('#menu_name').on('keyup', function () {
            generateCode()
        });

        function generateCode() {

            let menuName = $('#menu_name').val().split(" ").join("-").toLowerCase();
            let menuNumber = $('#hiddenMenuNumber').val();

            menuName = menuName.toLowerCase();

            $('#menu_code').val(menuName + '-' + menuNumber);
        }


        //datatable
        {{--function menuDatatable()--}}
        {{--{--}}
            {{--//dtaTable--}}
            {{--$('#menuListTbl').DataTable({--}}
                {{--// responsive: true,--}}
                {{--// processing: true,--}}
                {{--serverSide: true,--}}
                {{--ajax: {--}}
                    {{--headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
                    {{--url: '{{url("admin/get-mess-menus")}}',--}}
                    {{--type: "POST",--}}
                    {{--dataType: "json",--}}
                {{--},--}}
                {{--rowId: 'id',--}}
                {{--columns: [--}}
                    {{--{--}}
                        {{--"data": null, "render": function (data, type, full, meta) {--}}
                            {{--return meta.row + 1;--}}
                        {{--}--}}
                    {{--},--}}
                    {{--{data: 'menu_name', name: 'menu_name'},--}}
                    {{--{data: 'meal_type', name: 'meal_type'},--}}
                    {{--{data: 'status', name: 'status'},--}}
                    {{--// {data: 'items', name: 'items'},--}}
                    {{--{--}}
                        {{--"mRender": function (data, group, full, meta) {--}}


                            {{--let returnItem = full.items;--}}
                            {{--return full.items;--}}
                            {{--// let itemString = returnItem.replace(['"','[',']'],' ');--}}
                            {{--// return itemString;--}}

                            {{--returnItem.forEach((element) => {--}}

                                {{--console.log(element);--}}
                               {{--// if(element.length == 1)--}}
                               {{--// {--}}
                               {{--//     return 1--}}
                               {{--// }--}}
                               {{--// else if(element.length > 1)--}}
                               {{--// {--}}
                               {{--//     return 'many'--}}
                               {{--// }--}}
                               {{--// else--}}
                               {{--// {--}}
                               {{--//     return 0--}}
                               {{--// }--}}

                               {{--// return  '<span class="badge badge-info">'+element+'</span>&nbsp;';--}}

                            {{--});--}}




                        {{--}--}}
                    {{--},--}}
                    {{--{data: 'action', name: 'action'},--}}

                {{--]--}}
            {{--});--}}



        {{--}--}}


    </script>

@endpush