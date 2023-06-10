@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Add Stock
            </div>
            <div class="card-body">

                <form method="POST" action="{{route('category.store')}}">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select aria-hidden="true" id="category" class="form-control" name="category">
                                    @foreach($barCategories as $barCategory)
                                        <option value="{{ $barCategory->code }}">{{$barCategory->name  }} </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sub_category">Sub Category</label>
                                <select disabled aria-hidden="true" id="sub_category" class="form-control" name="sub_category">

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="child_category">Child Category</label>
                                <select disabled aria-hidden="true" id="child_category" class="form-control" name="child_category">

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="measure_unit">Measure Unit</label>
                                <select aria-hidden="true" id="measure_unit" class="form-control" name="measure_unit">
                                    @foreach($measureUnits->measure_units as $measureUnit)
                                        <option value="{{ $measureUnit->id }}">{{$measureUnit->abbreviation}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="item">Item</label>
                            <input type="text" class="form-control" name="item" id="item">
                            @error('item')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary mt-4 p-2 float-right" id="btn_itm_save">Save Item</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>




@endsection

@push('scripts')

    <script>
        $(document).ready(function () {

            $("#category").change(function() {
                let category = this.value;

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url: '{{route('get-stock-cat')}}',
                    type: 'POST',
                    data: {category: category},
                    success: function (response) {

                        if(response.length != 0)
                        {
                            $("#sub_category").prop( "disabled", false );

                            let options='',
                                defaultOption = "<option value='' selected>Select Sub Category</option>";

                            response.forEach(function (currentValue, index, arr) {
                                options += "<option value='" + currentValue.code + "'>" + currentValue.name + "</option>";
                            });
                            $("#sub_category").html(defaultOption + options);
                        }
                        else
                        {
                            $("#sub_category").val('').change();
                            $("#sub_category").prop( "disabled", true );
                        }



                    },
                    error: function (error) {
                    }
                });

            });

            $("#sub_category").change(function() {
                let sub_category = this.value;

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url: '{{route('get-stock-sub-cat')}}',
                    type: 'POST',
                    data: {sub_category: sub_category},
                    success: function (response) {


                        if(response.length != 0) {

                            $("#child_category").prop("disabled", false);

                            let options = '',
                                defaultOption = "<option value='' selected>Select Child Category</option>";

                            response.forEach(function (currentValue, index, arr) {
                                options += "<option value='" + currentValue.code + "'>" + currentValue.name + "</option>";
                            });
                            $("#child_category").html(defaultOption + options);
                        }
                        else
                        {
                            $("#child_category").val('').change();
                            $("#child_category").prop( "disabled", true );
                        }

                    },
                    error: function (error) {
                    }
                });

            });

            //save item
            $("#btn_itm_save").click(function() {
                let category = $("#category").val();
                let sub_category = $("#sub_category").val();
                let child_category =  $("#child_category").val();
                let measure_unit = $('#measure_unit').val();
                let item_name = $('#item').val();

                if (item_name)
                {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: 'json',
                        url: '{{route('save-stock-item')}}',
                        type: 'POST',
                        data: {category: category, sub_category:sub_category, child_category:child_category, measure_unit:measure_unit, item_name:item_name},
                        success: function (response) {

                            alert('Item saved')
                            location.reload();
                        },
                        error: function (error) {
                        }
                    });
                }
                else
                {
                    alert('Item name is required');
                }


            });
        });
    </script>

@endpush

