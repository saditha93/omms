{{--@extends('layouts.app')--}}

{{--@section('content')--}}

    {{--<div class="col-md-12 pt-2">--}}
        {{--<div class="card">--}}
            {{--<div class="card-header">--}}
                {{--Event Orders3--}}
                {{--<input type="text" class="form-control" id="pending_no" name="pending_no">--}}
            {{--</div>--}}


            {{--<form method="POST" id="eventOrderMainForm" name="eventOrderMainForm" enctype="multipart/form-data">--}}
                {{--@csrf--}}

            {{--<div class="card-body">--}}


                    {{--<div class="row">--}}
                        {{--<div class="col-md-6">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="event">Event Name</label>--}}
                                {{--<input type="text" id="event" class="form-control" name="event">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-6">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="officer" class="form-label">Respective Officers</label>--}}
                                {{--<select id="officer"--}}
                                        {{--class="select2-single form-control" name="officer">--}}
                                    {{--<option value="">Select the name</option>--}}
                                    {{--@foreach($officers as $officer)--}}
                                        {{--<option value="{{$officer->id}}">{{ $officer->name_according_to_part2 .' - '. $officer->service_no}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="officer_appointment">Officer Appointment</label>--}}
                                {{--<input type="text" id="officer_appointment" class="form-control" name="officer_appointment">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="officer_contact">Officer Contact</label>--}}
                                {{--<input type="text" id="officer_contact" class="form-control" name="officer_contact">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="due_date">Due Date</label>--}}
                                {{--<input type="date" id="due_date" class="form-control" name="due_date">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="due_time">Due Time</label>--}}
                                {{--<input type="time" id="due_time" class="form-control" name="due_time">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
            {{--</div>--}}

            {{--<div class="card-body">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-3">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="item">Item</label>--}}
                                {{--<input type="text" id="item" class="form-control item_input" name="item">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="meal_type">Meal type</label>--}}
                                {{--<select id="meal_type" class="form-control meal_type_input" name="meal_type">--}}
                                    {{--<option value="Non-Vegetarian">Non-Vegetarian</option>--}}
                                    {{--<option value="Vegetarian">Vegetarian</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="item_qty">Qty</label>--}}
                                {{--<input type="text" id="item_qty" class="form-control item_qty_input" name="item_qty">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="item_rem">Remarks</label>--}}
                                {{--<input type="text" id="item_rem" class="form-control item_rem_input" name="item_rem">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-1">--}}
                            {{--<div class="form-group mt-2">--}}
                                {{--<button type="button" class="btn btn-primary mt-4 float-right" id="btn_itm_add">Add</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}


                        {{--<div class="col-md-12">--}}
                            {{--<table id="event_order_table" class="display" style="width:100%">--}}
                                {{--<thead>--}}
                                    {{--<tr>--}}
                                        {{--<th>Item</th>--}}
                                        {{--<th>Meal Type</th>--}}
                                        {{--<th>Qty</th>--}}
                                        {{--<th>Remark</th>--}}
                                        {{--<th>Action</th>--}}
                                    {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tbody>--}}

                                {{--</tbody>--}}
                            {{--</table>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-1 offset-md-11">--}}
                            {{--<div class="form-group">--}}
                                {{--<button type="button" class="btn btn-primary float-right" id="btn_event_main_save">Save</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</form>--}}
        {{--</div>--}}
    {{--</div>--}}




{{--@endsection--}}

{{--@push('scripts')--}}

    {{--<script>--}}
        {{--$(document).ready(function () {--}}

            {{--let itemDt = $('#event_order_table').DataTable();--}}


            {{--$('#btn_itm_add').on('click', function () {--}}

                {{--let item = $(this).closest('.card-body').find('.item_input').val();--}}
                {{--let mealType = $(this).closest('.card-body').find('.meal_type_input').val();--}}
                {{--let qty = $(this).closest('.card-body').find('.item_qty_input').val();--}}
                {{--let remark = $(this).closest('.card-body').find('.item_rem_input').val();--}}
                {{--let removeBtn = `<button type="button" class="btn btn-danger dtItemRemove">Remove</button>`;--}}

                {{--itemDt.row.add([--}}
                     {{--`<input type="text" name="tb_item" value="`+item+`">`,--}}
                     {{--`<input type="text" name="tb_mealType" value="`+mealType+`">`,--}}
                     {{--`<input type="text" name="tb_qty" value="`+qty+`">`,--}}
                     {{--`<input type="text" name="tb_remark" value="`+remark+`">`,--}}
                      {{--removeBtn--}}
                {{--]).draw(false);--}}

                {{--$('.item_input').val('');--}}
                {{--$('.meal_type_input').val('');--}}
                {{--$('.item_qty_input').val('');--}}
                {{--$('.item_rem_input').val('');--}}

            {{--});--}}
            {{--$("#event_order_table").on('click', '.dtItemRemove', function () {--}}

                {{--itemDt.row( $(this).parents('tr') )--}}
                    {{--.remove()--}}
                    {{--.draw();--}}
            {{--} );--}}


            {{--$('#btn_event_main_save').on('click', function () {--}}

                {{--// let formMethod = $('#stockProductsForm').serialize();--}}
                {{--var form = document.getElementById('eventOrderMainForm');--}}
                {{--var formData = new FormData(form); //create a object--}}

                {{--$.ajax({--}}
                    {{--headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
                    {{--contentType: false,--}}
                    {{--processData: false,--}}
                    {{--dataType: 'json',--}}
                    {{--url: '{{route('save-eventOrder-main')}}',--}}
                    {{--type: 'POST',--}}
                    {{--data: formData,--}}
                    {{--success: function (response) {--}}

                        {{--$('#pending_no').val(response)--}}
                    {{--},--}}
                    {{--error: function (error) {--}}
                    {{--}--}}
                {{--});--}}

            {{--});--}}

        {{--});--}}
    {{--</script>--}}

{{--@endpush--}}

