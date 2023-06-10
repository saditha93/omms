@extends('layouts.app')


@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Edit Role
            </div>
            <div class="card-body">
                <div class="pull-right">
                    <a class="btn btn-info btn-sm" href="{{ route('roles.index') }}"> Back</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                        <div class="form-group">
                            <label for="module_type">Module Type</label>
                            <select name="module_type" id="module_type" class="form-control">
                                <option value="Demand-Management-Module" {{isset($role)?$role->module=='Demand-Management-Module'?'selected':'':''}}>Demand Management Module</option>
                                <option value="Stock-Management-Module" {{isset($role)?$role->module=='Stock-Management-Module'?'selected':'':''}}>Stock Management Module</option>
                                <option value="Bar-Management-Module" {{isset($role)?$role->module=='Bar-Management-Module'?'selected':'':''}}>Bar Management Module</option>
                                <option value="Bill-Management-Module" {{isset($role)?$role->module=='Bill-Management-Module'?'selected':'':''}}>Bill Management Module</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">

                        <strong>Permission</strong>

                        <div class="form-group mt-5">

                            {{--Ration--}}
                            <div class="row mt-5 mb-2 text-maroon"><label>Demand Management Module</label></div>
                            <div class="row">
                                @foreach($permission as $value)

                                    @if($value->name == 'manage-users' || $value->name == 'manage-roles' || $value->name == 'view-mess-item-categories' ||
                                  $value->name == 'manage-sub-menu-items' || $value->name == 'manage-mess-menus' || $value->name == 'add-daily-rations' ||
                                  $value->name == 'add-tea-items' || $value->name == 'add-extra-messing' || $value->name == 'add-desserts' || $value->name == 'place-orders' ||
                                  $value->name == 'view-orders' || $value->name == 'register-officers')

                                        <div class="form-check w-25">
                                            <input class="form-check-input" type="checkbox" value="{{$value->id}}"
                                                   name="permission[]" {{$rolePermissions?((in_array($value->id, $rolePermissions))?'checked':''):''}}>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{--                                                                                        {{ $value->name }}--}}

                                                @if($value->name == 'manage-users')
                                                    Manage Users
                                                @elseif($value->name == 'manage-roles')
                                                    Manage Roles
                                                @elseif($value->name == 'view-mess-item-categories')
                                                    View Mes Item Category
                                                @elseif($value->name == 'manage-sub-menu-items')
                                                    Manage Add Menu Items
                                                @elseif($value->name == 'manage-mess-menus')
                                                    Manage Mess Menus
                                                @elseif($value->name == 'add-daily-rations')
                                                    Add Daily Rations
                                                @elseif($value->name == 'add-tea-items')
                                                    Add Tea Items
                                                @elseif($value->name == 'add-extra-messing')
                                                    Add Extra Messing
                                                @elseif($value->name == 'add-desserts')
                                                    Add Desserts
                                                @elseif($value->name == 'place-orders')
                                                    Place Orders
                                                @elseif($value->name == 'view-orders')
                                                    View Orders
                                                @elseif($value->name == 'register-officers')
                                                    Register Officers
                                                @endif
                                            </label>
                                        </div>

                                    @endif
                                @endforeach
                            </div>

                            {{--Stock--}}
                            <div class="row mt-5 mb-2 text-maroon"><label>Stock Management Module</label></div>
                            <div class="row">
                                @foreach($permission as $value)

                                    @if($value->name == 'stock-view' || $value->name == 'grn-list' || $value->name == 'issue-list' || $value->name == 'item-list' ||
                                   $value->name == 'stock-list' || $value->name == 'reports-list' || $value->name == 'stock-book' || $value->name == 'category-list' ||
                                   $value->name == 'measureUnit-list' || $value->name == 'Supplier List' || $value->name =='supplier-list')

                                        <div class="form-check w-25">
                                            <input class="form-check-input" type="checkbox" value="{{$value->id}}"
                                                   name="permission[]" {{$rolePermissions?((in_array($value->id, $rolePermissions))?'checked':''):''}}>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{--                                                                                        {{ $value->name }}--}}

                                                @if($value->name == 'stock-view')
                                                    Stock View
                                                @elseif($value->name == 'grn-list')
                                                    GRN List
                                                @elseif($value->name == 'issue-list')
                                                    Issue List
                                                @elseif($value->name == 'item-list')
                                                    Item List
                                                @elseif($value->name == 'stock-list')
                                                    Stock List
                                                @elseif($value->name == 'reports-list')
                                                    Reports List
                                                @elseif($value->name == 'stock-book')
                                                    Stock Book
                                                @elseif($value->name == 'category-list')
                                                    Category List
                                                @elseif($value->name == 'measureUnit-list')
                                                    MeasureUnit List
                                                @elseif($value->name == 'supplier-list')
                                                    Supplier List
                                                @endif
                                            </label>
                                        </div>

                                    @endif
                                @endforeach
                            </div>


                            {{--Bar--}}
                            <div class="row mt-5 mb-2 text-maroon"><label>Bar Management Module</label></div>
                            <div class="row">
                                @foreach($permission as $value)

                                    @if($value->name == 'bar-orders' || $value->name == 'bar-stock')


                                        <div class="form-check w-25">
                                            <input class="form-check-input" type="checkbox" value="{{$value->id}}"
                                                   name="permission[]" {{$rolePermissions?((in_array($value->id, $rolePermissions))?'checked':''):''}}>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                @if($value->name == 'bar-orders')
                                                    Bar Orders
                                                @elseif($value->name == 'bar-stock')
                                                    Bar Stock (Stock View)
                                                @endif
                                            </label>
                                        </div>

                                    @endif
                                @endforeach
                            </div>


                            {{--Billing--}}
                            <div class="row mt-5 mb-2 text-maroon"><label>Billing Module</label></div>
                            <div class="row">
                                @foreach($permission as $value)

                                    @if($value->name == 'billing' || $value->name == 'view-report-messing' || $value->name == 'view-report-bar'
                                    || $value->name == 'view-report-all' || $value->name == 'billing-event' || $value->name == 'billing-general' || $value->name == 'view-report-event' || $value->name == 'view-report-general')

                                        <div class="form-check w-25">
                                            <input class="form-check-input" type="checkbox" value="{{$value->id}}"
                                                   name="permission[]" {{$rolePermissions?((in_array($value->id, $rolePermissions))?'checked':''):''}}>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                @if($value->name == 'billing')
                                                    Mess Billing
                                                @elseif($value->name == 'billing-event')
                                                    Billing Event
                                                @elseif($value->name == 'billing-general')
                                                    Billing General Deductions
                                                @elseif($value->name == 'view-report-event')
                                                    View Event Report
                                                @elseif($value->name == 'view-report-general')
                                                    View General Deduction Report
                                                @elseif($value->name == 'view-report-bar')
                                                    View Bar Report
                                                @elseif($value->name == 'view-report-all')
                                                    View All Report
                                                @elseif($value->name == 'view-report-messing')
                                                    View Messing Report
                                                @endif
                                            </label>
                                        </div>

                                    @endif
                                @endforeach
                            </div>


                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
