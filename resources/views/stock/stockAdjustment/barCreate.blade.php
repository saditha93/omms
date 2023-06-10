@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Stock Re Order Level</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Stock</li>
                            <li class="breadcrumb-item active">Re Order Level</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Stock Re Order Level</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('bar.stock.store') }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-3" for="item_id">Item</label>
                            <div class="col-sm-9">
                                <select required name="item_id" id="item_id"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a Item</option>
                                    @foreach($items as $item)
                                        <option @selected($item->id == old('item_id')) value="{{$item->id}}">{{$item->name}}
                                            - {{$item->measure_unit->abbreviation}}
                                            ({{$item->measure_unit->size}} {{$item->measure_unit->size_type}})</option>
                                    @endforeach
                                </select>
                                @error('item_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <input hidden type="text" name="stock_id"
                               class="form-control   @error('stock_id') is-invalid @enderror" id="stock_id"
                               value="{{ old('stock_id') }}">

                        <div class="form-group row">
                            <label class="col-sm-3" for="pre_stock">Available Stock</label>
                            <div class="col-sm-9">
                                <input readonly="readonly" type="text" name="pre_stock"
                                       class="form-control   @error('pre_stock') is-invalid @enderror" id="pre_stock"
                                       placeholder="Pre Stock" value="{{ old('pre_stock') }}">
                                @error('pre_stock')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="below_qty">Re-Order level</label>
                            <div class="col-sm-9">
                                <input type="text" name="below_qty"
                                       class="form-control   @error('below_qty') is-invalid @enderror" id="below_qty"
                                       placeholder="Re-Order level" value="{{ old('below_qty') }}">
                                @error('below_qty')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="remark">Remark</label>
                            <div class="col-sm-9">
                                <textarea type="text" name="remark"
                                          class="form-control   @error('remark') is-invalid @enderror"
                                          id="adjusted_stock"
                                          placeholder="Remark"> {{ old('remark') }}</textarea>
                                @error('remark')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('plugin/flowbite/flowbite.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('plugin/MCDatepicker/mc-calendar.min.css') }}"/>
@stop


@section('third_party_scripts')
    <script src="{{ asset('plugin/flowbite/datepicker.js') }}"></script>
    <script src="{{ asset('plugin/MCDatepicker/mc-calendar.min.js') }}"></script>
    <script src="{{ asset('plugin/flowbite/flowbite.js') }}"></script>
    <script>
        $('#item_id').change(function () {
            var id = $(this).val();

            $.ajax({
                url: '{{ route('ajax.getStock') }}',
                type: 'get',
                data: {
                    'id': id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#pre_stock').val(data.qty);
                    $('#below_qty').val(data.below_qty);
                    $('#stock_id').val(data.id);
                }
            });
        })
    </script>
@stop
