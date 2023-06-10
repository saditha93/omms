@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Categories</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">categories</li>
                            <li class="breadcrumb-item active">All</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Category Tree Of {{$establishment->name}}</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="panel panel-primary p-5 m-0">
                        <div class="row">
                            <div class="col-md-6">
                                <ul id="tree1">
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="{{ route('stockCategory.edit', $category->id) }}">{{ $category->name }}</a>
                                            @if(count($category->childs))
                                                @include('stock.category.manageChild',['childs' => $category->childs])
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{$dataTable->table()}}

                </div>

                <div class="card-footer">

                </div>
            </div>
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
    {!! $dataTable->scripts() !!}
@stop
