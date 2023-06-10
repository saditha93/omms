<?php

use App\Http\Controllers\AppMobile\MessAppController;
use App\Http\Controllers\BarController;
use App\Http\Controllers\MessMainController;
use App\Http\Controllers\Stock\ajaxController;
use App\Http\Controllers\Stock\CategoryController;
use App\Http\Controllers\Stock\GRNDetailController;
use App\Http\Controllers\Stock\GRNHeaderController;
use App\Http\Controllers\Stock\IssueDetailController;
use App\Http\Controllers\Stock\IssueHeaderController;
use App\Http\Controllers\Stock\ItemController;
use App\Http\Controllers\Stock\MeasureUnitController;
use App\Http\Controllers\Stock\ReportsController;
use App\Http\Controllers\ReportsController as MainReportsController;
use App\Http\Controllers\Stock\StockAdjustmentController;
use App\Http\Controllers\Stock\StockBookController;
use App\Http\Controllers\Stock\StockController;
use App\Http\Controllers\Stock\SupplierController;
use App\Models\Bar;
use App\Models\Stock\Category;
use App\Models\Stock\GRNHeader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();



Route::get('/admin', [\App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin', [\App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');
Route::get('/', [\App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm'])->name('admin.login.root');
Route::get('/omms', [\App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm'])->name('admin.login.root');

Route::get('/admin/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showAdminRegisterForm'])->name('admin.register-view');
Route::post('/admin/register', [\App\Http\Controllers\Auth\RegisterController::class, 'createAdmin'])->name('admin.register');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/dashboard', function () {

    $extraMessingDetails = \App\Models\ExtraOrders::join('users', 'users.email', '=', 'extra_orders.officer_id')
        ->join('mess_menu_items', 'mess_menu_items.id', '=', 'extra_orders.item_id')
        ->where('extra_orders.ordered_date', \Carbon\Carbon::today()->toDateString())
        ->where('extra_orders.mess_id', Auth::user()->mess_id)
        ->get(['users.name_according_to_part2', 'mess_menu_items.item_name', 'extra_orders.ordered_date']);

    $bar = Category::where('code', 'bar_item')->where('establishment_id', Auth::user()->mess_id)->first();
    $itemArray = [];
    $itemsCount = [];
    $barCount = [];
    $stockCount = [];
    $grnCount = [];
    $categories = [];
    if (auth()->user()->can('bar-stock')) {
        try {

            $itemArray = $bar->items()->get();
            $barcat = Category::where('code', 'bar_item')->where('establishment_id', Auth::user()->mess_id)->first();
            $categories = Category::where('parent_id', '=', $barcat->id)->where('establishment_id', Auth::user()->mess_id)->get();
            $itemsCount = $bar->items()->count();
            $stockCount = $itemsCount;
            $grnCount = GRNHeader::where('establishment_id', Auth::user()->mess_id)->whereYear('date', date('Y'))->where('is_bar', 1)->get()->count();
            $barCount = Bar::where('mess_id', Auth::user()->mess_id)->get()->count();
        } catch (\PHPUnit\Framework\Error $e) {
            $itemArray = [];
            $itemsCount = [];
            $stockCount = [];
            $barCount = [];
            $grnCount = [];
        }
    }
    return view('admin.admin', compact('extraMessingDetails', 'itemArray', 'itemsCount', 'stockCount', 'barCount', 'grnCount', 'categories'));
})->middleware('auth:admin');


Route::group(['middleware' => 'auth:admin'], function () {

    //bar
    Route::resource('/admin/bar', BarController::class);
    Route::post('/admin/get-bar-items', '\App\Http\Controllers\BarController@getBarItems')->name('get-bar-items');
    Route::post('/admin/get-bar-qty', '\App\Http\Controllers\BarController@getBarQty')->name('get-bar-qty');
    Route::post('/admin/save-bar-orders', '\App\Http\Controllers\BarController@saveBarOrders')->name('save-bar-orders');
    Route::post('/admin/officer-respective-bar-orders', '\App\Http\Controllers\BarController@officerRespectiveBarOrders')->name('officer-respective-bar-orders');
    Route::post('/admin/get-bar-measures', '\App\Http\Controllers\BarController@getBarMeasures')->name('get-bar-measures');


    Route::post('/admin/get-order-notifications', '\App\Http\Controllers\HomeController@getOrderNotifications')->name('get-order-notifications');
    Route::get('/admin/establishment-count', '\App\Http\Controllers\HomeController@establishmentCount')->name('establishment-count');
    Route::get('/admin/meal-count', '\App\Http\Controllers\HomeController@mealCount')->name('meal-count');
    Route::get('/admin/ration-data-count', '\App\Http\Controllers\HomeController@rationDataCount')->name('ration-data-count');
    Route::get('/admin/more-info-establishment', '\App\Http\Controllers\HomeController@moreInfoEstablishment')->name('more-info-establishment');
    Route::get('/admin/more-info-messes', '\App\Http\Controllers\HomeController@moreInfoMesses')->name('more-info-messes');
    Route::get('/admin/more-info-mess-managers', '\App\Http\Controllers\HomeController@moreInfoMessManagers')->name('more-info-mess-managers');
    Route::get('/admin/mess-info-officers', '\App\Http\Controllers\HomeController@messInfoOfficers')->name('mess-info-officers');
    Route::post('/admin/clear-dashboard-notification', '\App\Http\Controllers\HomeController@clearDashboardNotification')->name('clear-dashboard-notification');

    //last login
    Route::get('/admin/last-login', '\App\Http\Controllers\HomeController@lastLogin')->name('last-login');
    Route::get('/admin/officer-Strength', '\App\Http\Controllers\HomeController@officerStr')->name('officer-Strength');

    Route::resource('/admin/mess', \App\Http\Controllers\MessController::class);
    Route::post('/admin/establishment-messes', '\App\Http\Controllers\MessController@establishmentMesses')->name('establishment-messes');

    Route::resource('/admin/category', \App\Http\Controllers\MessMenuItemCategoryController::class);
    Route::resource('/admin/item', \App\Http\Controllers\MessMenuItemController::class);

    Route::post('/admin/get-menu-items', '\App\Http\Controllers\MessMenuController@getMenuItems')->name('get-menu-items');

    Route::resource('/admin/menu', \App\Http\Controllers\MessMenuController::class);
    Route::get('/admin/view-daily-menus', '\App\Http\Controllers\MessMenuController@viewDailyMenus')->name('view-daily-menus');
    Route::post('/admin/daily-get-mess-manger-data-filter', '\App\Http\Controllers\MessMenuController@dailyMenuFilter')->name('daily-menu-filter');
    Route::post('/admin/get-mess-menus', '\App\Http\Controllers\MessMenuController@getMessMenus')->name('get-mess-menus');

    //orders
    Route::resource('/admin/orders', \App\Http\Controllers\OrdersController::class);
    Route::post('/admin/get-officer-details', '\App\Http\Controllers\OrdersController@getOfficerDetails')->name('get-officer-details');
    Route::post('/admin/place-an-order', '\App\Http\Controllers\OrdersController@placeAnOrder')->name('place-an-order');
    Route::post('/admin/ration-search', '\App\Http\Controllers\OrdersController@rationSearch')->name('ration-search');
    Route::get('/admin/order-details', '\App\Http\Controllers\OrdersController@orderDetails')->name('order-details');
    Route::post('/admin/get-total-ration-for-the-day', '\App\Http\Controllers\OrdersController@getTotalRationForTheDay')->name('get-total-ration-for-the-day');


    Route::get('/admin/report-messing', '\App\Http\Controllers\ReportsController@reportMessing')->name('report-messing');
    Route::get('/admin/report-bar', '\App\Http\Controllers\ReportsController@reportBar')->name('report-bar');
    Route::get('/admin/report-event', '\App\Http\Controllers\ReportsController@reportEvent')->name('report-event');
    Route::get('/admin/report-general', '\App\Http\Controllers\ReportsController@reportGeneral')->name('report-general');
    Route::get('/admin/report-all', '\App\Http\Controllers\ReportsController@reportAll')->name('report-all');
    Route::get('/admin/report-all-officers', '\App\Http\Controllers\ReportsController@reportAllOfficers')->name('report-all-officers');
    Route::get('/admin/bill_payments', '\App\Http\Controllers\ReportsController@billPayments')->name('bill_payments');


    Route::post('/admin/messing_order_details', '\App\Http\Controllers\ReportsController@messingOrderDetails')->name('messing_order_details');

    Route::post('/admin/bar_order_details', '\App\Http\Controllers\ReportsController@barOrderDetails')->name('bar_order_details');

    Route::post('/admin/event_order_details', '\App\Http\Controllers\ReportsController@eventOrderDetails')->name('event_order_details');

    Route::post('/admin/general_details', '\App\Http\Controllers\ReportsController@generalDetails')->name('general_details');

    Route::post('/admin/all_order_details', '\App\Http\Controllers\ReportsController@allOrderDetails')->name('all_order_details');
    Route::post('/admin/all_officer_order_details', '\App\Http\Controllers\ReportsController@allOfficerOrderDetails')->name('all_officer_order_details');

//    //AE 19 04
    Route::get('/admin/generate-pdf-bill', '\App\Http\Controllers\ReportsController@generatePdfBill')->name('generate-pdf-bill');
//    //End 19 04



    Route::post('/admin/bill_payment', '\App\Http\Controllers\OrdersController@billPayment')->name('bill_payment');
    Route::post('/admin/remaining_payment', '\App\Http\Controllers\OrdersController@remainingPayment')->name('remaining_payment');


    Route::post('/admin/officer-respective-orders', '\App\Http\Controllers\OrdersController@officerRespectiveOrders')->name('officer-respective-orders');
    Route::post('/admin/officer-respective-extra-orders', '\App\Http\Controllers\OrdersController@officerRespectiveExtraOrders')->name('officer-respective-extra-orders');
//    Route::post('/admin/accept-ration-order', '\App\Http\Controllers\OrdersController@acceptRationOrder')->name('accept-ration-order');
    Route::post('/admin/cancel-ration-order', '\App\Http\Controllers\OrdersController@cancelRationOrder')->name('cancel-ration-order');

    Route::get('/admin/all-breakfast', '\App\Http\Controllers\OrdersController@allBbreakfast')->name('all-breakfast');
    Route::post('/admin/get-all-breakfasts', '\App\Http\Controllers\OrdersController@getAllBreakfasts')->name('get-all-breakfasts');

    Route::get('/admin/all-lunch', '\App\Http\Controllers\OrdersController@allLunch')->name('all-lunch');
    Route::post('/admin/get-all-lunch', '\App\Http\Controllers\OrdersController@getAllLunch')->name('get-all-lunch');

    Route::get('/admin/all-dinner', '\App\Http\Controllers\OrdersController@allDinner')->name('all-dinner');
    Route::post('/admin/get-all-dinner', '\App\Http\Controllers\OrdersController@getAllDinner')->name('get-all-dinner');

    Route::get('/admin/all-event', '\App\Http\Controllers\OrdersController@allEvent')->name('all-event');
    Route::post('/admin/get-all-event', '\App\Http\Controllers\OrdersController@getAllEvent')->name('get-all-event');

    Route::get('/admin/all-other', '\App\Http\Controllers\OrdersController@allOther')->name('all-other');
    Route::post('/admin/get-all-other-order', '\App\Http\Controllers\OrdersController@getAllOtherOrder')->name('get-all-other-order');

    Route::get('/admin/all-tea', '\App\Http\Controllers\OrdersController@allTea')->name('all-tea');
    Route::post('/admin/get-all-tea', '\App\Http\Controllers\OrdersController@getAllTea')->name('get-all-tea');

    Route::get('/admin/all-extra', '\App\Http\Controllers\OrdersController@allExtra')->name('all-extra');
    Route::post('/admin/get-all-extra', '\App\Http\Controllers\OrdersController@getAllExtra')->name('get-all-extra');

    Route::get('/admin/all-dessert', '\App\Http\Controllers\OrdersController@allDessert')->name('all-dessert');
    Route::post('/admin/get-all-dessert', '\App\Http\Controllers\OrdersController@getAllDessert')->name('get-all-dessert');


    Route::resource('/admin/ration', \App\Http\Controllers\MessDailyRationsController::class);
    Route::get('/admin/tea-items', '\App\Http\Controllers\MessDailyRationsController@teaItems')->name('tea-items');
    Route::post('/admin/tea-items-price-set', '\App\Http\Controllers\MessDailyRationsController@teaItemsPriceSet')->name('tea-items-price-set');
    Route::get('/admin/tea-item-edit/{id}', '\App\Http\Controllers\MessDailyRationsController@teaItemEdit')->name('tea-item-edit');
    Route::put('/admin/tea-item-update/{id}', '\App\Http\Controllers\MessDailyRationsController@teaItemUpdate')->name('tea-item-update');
    Route::delete('/admin/tea-item-delete/{id}', '\App\Http\Controllers\MessDailyRationsController@teaItemDelete')->name('tea-item-delete');
    Route::post('/admin/get-tea-items', '\App\Http\Controllers\MessDailyRationsController@getTeaItems')->name('get-tea-items');

    Route::get('/admin/extra-messing', '\App\Http\Controllers\MessDailyRationsController@extraMessing')->name('extra-messing');
    Route::post('/admin/extra-messing-price-set', '\App\Http\Controllers\MessDailyRationsController@extraMessingPriceSet')->name('extra-messing-price-set');
    Route::get('/admin/extra-messing-edit/{id}', '\App\Http\Controllers\MessDailyRationsController@extraMessingEdit')->name('extra-messing-edit');
    Route::put('/admin/extra-messing-update/{id}', '\App\Http\Controllers\MessDailyRationsController@extraMessingUpdate')->name('extra-messing-update');
    Route::post('/admin/get-extra-messing-items', '\App\Http\Controllers\MessDailyRationsController@getExtraMessingItems')->name('get-extra-messing-items');

    Route::get('/admin/dessert', '\App\Http\Controllers\MessDailyRationsController@dessert')->name('dessert');
    Route::post('/admin/dessert-items-price-set', '\App\Http\Controllers\MessDailyRationsController@dessertItemsPriceSet')->name('dessert-items-price-set');
    Route::get('/admin/dessert-item-edit/{id}', '\App\Http\Controllers\MessDailyRationsController@dessertItemEdit')->name('dessert-item-edit');
    Route::put('/admin/dessert-item-update/{id}', '\App\Http\Controllers\MessDailyRationsController@dessertItemUpdate')->name('dessert-item-update');
    Route::post('/admin/get-dessert-items', '\App\Http\Controllers\MessDailyRationsController@getDessertItems')->name('get-dessert-items');

    Route::post('/admin/menu-items', '\App\Http\Controllers\MessDailyRationsController@menuItems')->name('menu-items');
    Route::post('/admin/daily-ration-datatable', '\App\Http\Controllers\MessDailyRationsController@dailyRationDatatable')->name('daily-ration-datatable');
    Route::get('/admin/ration-count', '\App\Http\Controllers\MessDailyRationsController@rationCount')->name('ration-count');

    //event orders
    Route::resource('/admin/eventOrder', \App\Http\Controllers\EventOrdersController::class);
    Route::post('/admin/save-event-order-data', '\App\Http\Controllers\EventOrdersController@saveEventOrderData')->name('save-event-order-data');
    Route::post('/admin/view-requested-event-orders', '\App\Http\Controllers\EventOrdersController@viewRequestedEventOrders')->name('view-requested-event-orders');
    Route::post('/admin/update-event-order-status', '\App\Http\Controllers\EventOrdersController@updateEventOrderStatus')->name('update-event-order-status');
    Route::get('/admin/event-count', '\App\Http\Controllers\EventOrdersController@eventCount')->name('event-count');
    Route::get('/admin/rspnd-event-ntf-clear', '\App\Http\Controllers\EventOrdersController@rspndEventNtfClear')->name('rspnd-event-ntf-clear');

    //reports
    Route::get('/admin/reports/users', [MainReportsController::class, 'users'])->name('reports.users');
    Route::get('/admin/reports/user/{id}', [MainReportsController::class, 'user'])->name('reports.user');
    Route::get('/admin/reports/staffs', [MainReportsController::class, 'staffs'])->name('reports.staffs');
    Route::get('/admin/reports/staff/{id}', [MainReportsController::class, 'staff'])->name('reports.staff');

    //stock
//    Route::resource('/admin/stock', \App\Http\Controllers\StockController::class);
    Route::get('/admin/add-stock', '\App\Http\Controllers\StockController@addStock')->name('add-stock');
    Route::post('/admin/get-stock-cat', '\App\Http\Controllers\StockController@getStockCat')->name('get-stock-cat');
    Route::post('/admin/get-stock-sub-cat', '\App\Http\Controllers\StockController@getStockSubCat')->name('get-stock-sub-cat');
    Route::post('/admin/save-stock-item', '\App\Http\Controllers\StockController@saveStockItem')->name('save-stock-item');

    Route::resource('/admin/officer', \App\Http\Controllers\OfficerAccountsController::class);
    Route::post('/admin/get-Officer-data', '\App\Http\Controllers\OfficerAccountsController@getOfficerData')->name('get-Officer-data');
    Route::post('/admin/save-Officer-data', '\App\Http\Controllers\OfficerAccountsController@saveOfficerData')->name('save-Officer-data');
//    Route::post('/admin/save-Officer-data-bulk', '\App\Http\Controllers\OfficerAccountsController@saveOfficerDataBulk')->name('save-Officer-data-bulk');
//    Route::post('/admin/update-Officer-data-bulk', '\App\Http\Controllers\OfficerAccountsController@updateOfficerDataBulk')->name('update-Officer-data-bulk');
    Route::post('/admin/save-mess-manager-data', '\App\Http\Controllers\OfficerAccountsController@saveMessManagerData')->name('save-mess-manager-data');
    Route::get('/admin/get-mess-manger-data', '\App\Http\Controllers\OfficerAccountsController@getMessMangerData')->name('get-mess-manger-data');
    Route::post('/admin/user-inactive', '\App\Http\Controllers\OfficerAccountsController@userInactive')->name('user-inactive');
    Route::post('/admin/user-active', '\App\Http\Controllers\OfficerAccountsController@userActive')->name('user-active');


    Route::resource('/admin/establishment', \App\Http\Controllers\EstablishmentsController::class);
    Route::post('/admin/establishment-code', '\App\Http\Controllers\EstablishmentsController@establishmentCode')->name('establishment-code');
    Route::get('/admin/establishment-user', '\App\Http\Controllers\EstablishmentsController@establishmentUser')->name('establishment-user');
    Route::get('/admin/event-order', '\App\Http\Controllers\EstablishmentsController@eventOrder')->name('event-order');
    Route::get('/admin/view-event-order', '\App\Http\Controllers\EstablishmentsController@viewEventOrder')->name('view-event-order');
    Route::get('/admin/ahq-establishment', '\App\Http\Controllers\EstablishmentsController@ahqEstablishment')->name('ahq-establishment');
    Route::post('/admin/save-ahq-establishment', '\App\Http\Controllers\EstablishmentsController@saveAhqEstablishment')->name('save-ahq-establishment');
    Route::get('/admin/edit-ahq-establishment/{id}', '\App\Http\Controllers\EstablishmentsController@editAhqEstablishment')->name('edit-ahq-establishment');
    Route::put('/admin/update-ahq-establishment/{id}', '\App\Http\Controllers\EstablishmentsController@updateAhqEstablishment')->name('update-ahq-establishment');
    Route::post('/admin/get-officer-to-establishment', '\App\Http\Controllers\EstablishmentsController@getOfficerToEstablishment')->name('get-officer-to-establishment');
    Route::post('/admin/add-officer-to-ahq-estb', '\App\Http\Controllers\EstablishmentsController@addOfficerToAhqEstb')->name('add-officer-to-ahq-estb');

    //spatie
    Route::resource('/admin/roles', \App\Http\Controllers\RoleController::class);
    Route::resource('/admin/users', \App\Http\Controllers\AdminController::class);
    Route::get('/admin/mess-manager', '\App\Http\Controllers\AdminController@createMessManager')->name('mess-manager');
    Route::post('/admin/get-admins', '\App\Http\Controllers\AdminController@getAdmins')->name('get-admins');
    Route::get('/admin/get-system-user-data', '\App\Http\Controllers\AdminController@getSystemUserData')->name('get-system-user-data');
    Route::post('/admin/save-system-user-data', '\App\Http\Controllers\AdminController@saveSystemUserData')->name('save-system-user-data');
    Route::get('/admin/admin-password', '\App\Http\Controllers\AdminController@adminPassword')->name('admin-password');
    Route::post('/admin/reset-admin-password', '\App\Http\Controllers\AdminController@resetAdminPassword')->name('reset-admin-password');
    Route::post('/admin/reset-system-admins-password', '\App\Http\Controllers\AdminController@resetSystemAdminsPassword')->name('reset-system-admins-password');

    Route::post('/admin/staff-deactivate', '\App\Http\Controllers\AdminController@staffDeactivate')->name('staff-deactivate');
    Route::post('/admin/activate-staff-user', '\App\Http\Controllers\AdminController@activateStaffUser')->name('activate-staff-user');

    Route::post('/admin/deactivate-mess-manager', '\App\Http\Controllers\OfficerAccountsController@deactivateMessManager')->name('deactivate-mess-manager');
    Route::post('/admin/re-activate-mess-manager', '\App\Http\Controllers\OfficerAccountsController@reActivateMessManager')->name('re-activate-mess-manager');

    // settings
    Route::get('/admin/settings', '\App\Http\Controllers\SettingsController@index')->name('settings');
    Route::post('/admin/store-logo', '\App\Http\Controllers\SettingsController@storeLogo')->name('store-logo');
    Route::get('/admin/meal-time', '\App\Http\Controllers\SettingsController@mealTime')->name('meal-time');
    Route::post('/admin/save-meal-order-time', '\App\Http\Controllers\SettingsController@saveMealOrderTime')->name('save-meal-order-time');
    Route::get('/admin/update-meal-order-time/{id}', '\App\Http\Controllers\SettingsController@updateMealOrderTime')->name('update-meal-order-time');
    Route::put('/admin/update-order-times/{id}', '\App\Http\Controllers\SettingsController@updateOrderTimes')->name('update-order-times');
    Route::post('/admin/get-valid-order-time', '\App\Http\Controllers\SettingsController@getValidOrderTime')->name('get-valid-order-time');

//    Route::post('/admin/mess-manager-store', '\App\Http\Controllers\AdminController@store')->name('mess-manager-store');
//    Route::get('/admin/mess-manager-edit/{id}', '\App\Http\Controllers\AdminController@editMessManager')->name('mess-manager-edit');
//    Route::put('/admin/mess-manager-update/{id}', '\App\Http\Controllers\AdminController@update')->name('mess-manager-update');

    // Billing
    Route::get('/admin/billing_mess', '\App\Http\Controllers\OrdersController@billingMess')->name('billing_mess');
    Route::get('/admin/billing_event', '\App\Http\Controllers\OrdersController@billingEvent')->name('billing_event');
    Route::get('/admin/billing_general', '\App\Http\Controllers\OrdersController@billingGeneral')->name('billing_general');

    Route::post('/admin/billing_event_save', '\App\Http\Controllers\OrdersController@billingEventSave')->name('billing_event_save');
    Route::post('/admin/general_deduction_save', '\App\Http\Controllers\OrdersController@generalSave')->name('general_deduction_save');


    Route::post('/admin/billing_messing', '\App\Http\Controllers\OrdersController@billingMessing')->name('billing_messing');
    Route::post('/admin/billing_messing_update', '\App\Http\Controllers\OrdersController@billingMessingUpdate')->name('billing_messing_update');

    Route::post('/admin/billing_extra_messing', '\App\Http\Controllers\OrdersController@billingExtraMessing')->name('billing_extra_messing');
    Route::post('/admin/billing_extra_messing_update', '\App\Http\Controllers\OrdersController@billingExtraMessingUpdate')->name('billing_extra_messing_update');

    Route::post('/admin/billing_tea', '\App\Http\Controllers\OrdersController@billingTea')->name('billing_tea');
    Route::post('/admin/billing_tea_update', '\App\Http\Controllers\OrdersController@billingTeaUpdate')->name('billing_tea_update');

    //truncate
    Route::get('/admin/truncate-omms', '\App\Http\Controllers\MessController@truncateOmms')->name('truncate-omms');

    Route::prefix('admin')->group(function () {

        Route::get('/bargrn_create', [GRNHeaderController::class, 'barGrn'])->name('bar.grn.create');
        Route::get('/bargrn_index', [GRNHeaderController::class, 'barGrnIndex'])->name('gRNHeader.bar.index');
        Route::post('/barStore', [GRNHeaderController::class, 'barStore'])->name('bar.barStore');
        Route::get('/bargrnItems', [GRNDetailController::class, 'barGRNItem'])->name('bar.grn.item');
        Route::get('/barsupplier', [SupplierController::class, 'index'])->name('bar.supplier');
        Route::get('/barsupplier/create', [SupplierController::class, 'barCreate'])->name('bar.supplier.create');
        Route::post('/barsupplierStore', [SupplierController::class, 'barStore'])->name('bar.supplier.store');
        Route::get('/barsettings/barCat', [CategoryController::class, 'barIndex'])->name('barCategory.index');
        Route::get('/barsettings/barCat/edit/{id}', [CategoryController::class, 'baredit'])->name('barCategory.edit');
        Route::get('/barsettings/measureUnit/edit/{id}', [MeasureUnitController::class, 'baredit'])->name('barmeasureUnit.edit');
        Route::get('/barsettings/measureUnit', [MeasureUnitController::class, 'barIndex'])->name('barmeasureUnit.index');
        Route::get('/barsettings/measureUnit/create', [MeasureUnitController::class, 'barCreate'])->name('barmeasureUnit.create');
        Route::get('/barsettings/barCat/create', [CategoryController::class, 'barCreate'])->name('barCategory.create');
        Route::post('/barsettings/barCat/store', [CategoryController::class, 'barStore'])->name('barCategory.store');
        Route::post('/barsettings/measureUnit/store', [MeasureUnitController::class, 'barStore'])->name('barmeasureUnit.store');
        Route::get('/barstockAdjustment/create', [StockAdjustmentController::class, 'barCreate'])->name('barstockAdjustment.create');
        Route::post('/barstockAdjustment/store', [StockAdjustmentController::class, 'barStore'])->name('bar.stock.store');
        Route::get('/bar_report/barsingleitem', [ReportsController::class, 'barsingleitem'])->name('reports.barsingleitem');
        Route::get('/bar_report/bargrnin', [ReportsController::class, 'bargrnin'])->name('reports.bargrnin');
        Route::get('/bar_report/bargrnprice', [ReportsController::class, 'bargrnprice'])->name('reports.bargrnprice');
        Route::get('/bar_report/barallitems', [ReportsController::class, 'barallitems'])->name('reports.barallitems');
        Route::get('/bar_report/barstock', [ReportsController::class, 'barstock'])->name('reports.barstock');
        Route::get('/bar_report/baroutstock', [ReportsController::class, 'baroutstock'])->name('reports.baroutstock');

        Route::prefix('stock')->group(function () {
            Route::get('home', [App\Http\Controllers\Stock\HomeController::class, 'index'])->name('stock.home');

            Route::get('/profile', [App\Http\Controllers\Stock\HomeController::class, 'changePassword'])->name('stock.profile');
            Route::post('/profile', [App\Http\Controllers\Stock\HomeController::class, 'updatePassword'])->name('stock.update-password');
            Route::resource('stockItem', ItemController::class);
            Route::resource('stock', StockController::class);
            Route::resource('stockAdjustment', StockAdjustmentController::class);
            Route::resource('supplier', SupplierController::class);
            Route::resource('gRNHeader', GRNHeaderController::class);
            Route::resource('gRNDetail', GRNDetailController::class);
            Route::resource('issueHeader', IssueHeaderController::class);
            Route::resource('issueDetail', IssueDetailController::class);
            Route::get('/bar_stock', [StockController::class, 'barStock'])->name('bar.stock');
            Route::get('/bar_orders', [BarController::class, 'barOrders'])->name('bar.orders');

            Route::get('/bar_item_create', [ItemController::class, 'barItemCreate'])->name('bar.barItem');
            Route::post('/bar_store', [ItemController::class, 'barstore'])->name('bar.barstore');
            Route::post('/barupdate', [ItemController::class, 'barupdate'])->name('bar.barupdate');
            Route::get('/barItem/create', [ItemController::class, 'barItemCreate'])->name('bar.barItem.create');
            Route::get('/barItem', [ItemController::class, 'allBarItem'])->name('bar.allBarItem');
            Route::get('/stockBook/selcetQuarter', [StockBookController::class, 'SelcetQuarter'])->name('stockBook.selcetQuarter');
            Route::get('/stockBook/detailsQuarter', [StockBookController::class, 'DetailsQuarter'])->name('stockBook.detailsQuarter');
            Route::get('/reports/singleitem', [ReportsController::class, 'singleitem'])->name('reports.singleitem');
            Route::get('/reports/grnin', [ReportsController::class, 'grnin'])->name('reports.grnin');
            Route::get('/reports/in', [ReportsController::class, 'in'])->name('reports.in');
            Route::get('/reports/grnprice', [ReportsController::class, 'grnprice'])->name('reports.grnprice');
            Route::get('/reports/allitems', [ReportsController::class, 'allitems'])->name('reports.allitems');
            Route::get('/reports/stock', [ReportsController::class, 'stock'])->name('reports.stock');
            Route::get('/reports/recive_expier', [ReportsController::class, 'recive_expier'])->name('reports.recive_expier');
            Route::get('/reports/outstock', [ReportsController::class, 'outstock'])->name('reports.outstock');
            Route::prefix('settings')->group(function () {
                Route::resource('stockCategory', CategoryController::class);
                Route::resource('measureUnit', MeasureUnitController::class);
            });

        });

        Route::get('/ajax/getCategory', [ajaxController::class, 'getCategory'])->name('ajax.getCategory');
        Route::get('/ajax/getPrice', [ajaxController::class, 'getPrice'])->name('ajax.getPrice');
        Route::get('/ajax/closeGRN', [ajaxController::class, 'closeGRN'])->name('ajax.closeGRN');
        Route::get('/ajax/closeIN', [ajaxController::class, 'closeIN'])->name('ajax.closeIN');
        Route::get('/ajax/getTreeCategory', [ajaxController::class, 'getTreeCategory'])->name('ajax.getTreeCategory');
        Route::get('/ajax/getMeasureUnit', [ajaxController::class, 'getMeasureUnit'])->name('ajax.getMeasureUnit');
        Route::get('/ajax/getStock', [ajaxController::class, 'getStock'])->name('ajax.getStock');
        Route::get('/ajax/getSupplier', [ajaxController::class, 'getSupplier'])->name('ajax.getSupplier');
        Route::get('/ajax/getItem', [ajaxController::class, 'getItem'])->name('ajax.getItem');
        Route::get('/ajax/getGRN', [ajaxController::class, 'getGRN'])->name('ajax.getGRN');
        Route::get('/ajax/getIN', [ajaxController::class, 'getIN'])->name('ajax.getIN');
        Route::get('/ajax/getINEST', [ajaxController::class, 'getINEST'])->name('ajax.getINEST');
        Route::get('/ajax/getGRNPrice', [ajaxController::class, 'getGRNPrice'])->name('ajax.getGRNPrice');
        Route::get('/ajax/getCatStock', [ajaxController::class, 'getCatStock'])->name('ajax.getCatStock');
        Route::get('/ajax/getCatEstStock', [ajaxController::class, 'getCatEstStock'])->name('ajax.getCatEstStock');
        Route::get('/ajax/getGRNExpir', [ajaxController::class, 'getGRNExpir'])->name('ajax.getGRNExpir');
        Route::get('/ajax/getOutStock', [ajaxController::class, 'getOutStock'])->name('ajax.getOutStock');
        Route::get('/ajax/getOutStockRation', [ajaxController::class, 'getOutStockRation'])->name('ajax.getOutStockRation');
        Route::get('/ajax/getOutStockBar', [ajaxController::class, 'getOutStockBar'])->name('ajax.getOutStockBar');
        Route::get('/ajax/grnAvalable', [ajaxController::class, 'grnAvalable'])->name('ajax.grnAvalable');
        Route::get('/ajax/getMesCategory', [ajaxController::class, 'getMesCategory'])->name('ajax.getMesCategory');



    });


    // Billing
    Route::get('/admin/billing', '\App\Http\Controllers\OrdersController@billing')->name('billing');

    Route::post('/admin/billing_messing', '\App\Http\Controllers\OrdersController@billingMessing')->name('billing_messing');
    Route::post('/admin/billing_messing_update', '\App\Http\Controllers\OrdersController@billingMessingUpdate')->name('billing_messing_update');

    Route::post('/admin/billing_extra_messing', '\App\Http\Controllers\OrdersController@billingExtraMessing')->name('billing_extra_messing');
    Route::post('/admin/billing_extra_messing_update', '\App\Http\Controllers\OrdersController@billingExtraMessingUpdate')->name('billing_extra_messing_update');

    Route::post('/admin/billing_tea', '\App\Http\Controllers\OrdersController@billingTea')->name('billing_tea');
    Route::post('/admin/billing_tea_update', '\App\Http\Controllers\OrdersController@billingTeaUpdate')->name('billing_tea_update');

});


//// App_Mobile ////

//URL Redirections
Route::get('app_mobile/select_mess/{enum?}/{id?}/{auth?}', [App\Http\Controllers\AppMobile\MessMainController::class, 'select_mess'])->name('user.select_mess');
Route::get('/app_mobile/dashboard', [App\Http\Controllers\AppMobile\MessMainController::class, 'dashboard'])->name('app_mobile.dashboard');
Route::get('/app_mobile/messing', [App\Http\Controllers\AppMobile\MessMainController::class, 'messing'])->name('app_mobile.messing');
Route::get('/app_mobile/extra_messing', [App\Http\Controllers\AppMobile\MessMainController::class, 'extra_messing'])->name('app_mobile.extra_messing');
Route::get('/app_mobile/bar', [App\Http\Controllers\AppMobile\MessMainController::class, 'bar'])->name('app_mobile.bar');
Route::get('/app_mobile/mess_bill', [App\Http\Controllers\AppMobile\MessMainController::class, 'mess_bill'])->name('app_mobile.mess_bill');
Route::get('/app_mobile/summary', [App\Http\Controllers\AppMobile\MessMainController::class, 'summary'])->name('app_mobile.summary');
//URL Redirections

// FUNCTIONS
// Select Mess
Route::post('/app_mobile/user_authenticate', [App\Http\Controllers\AppMobile\MessMainController::class, 'user_authenticate'])->name('app_mobile.user_authenticate');
Route::post('/app_mobile/personal_details', [App\Http\Controllers\AppMobile\MessMainController::class, 'personal_details'])->name('app_mobile.personal_details');
Route::post('/app_mobile/set_mess_id', [App\Http\Controllers\AppMobile\MessMainController::class, 'set_mess_id'])->name('app_mobile/set_mess_id');
// Select Mess

// Messing
Route::post('/app_mobile/get_status_messing', [App\Http\Controllers\AppMobile\MessAppController::class, 'get_status_messing']);

Route::post('/app_mobile/menu_breakfast', [App\Http\Controllers\AppMobile\MessAppController::class, 'menu_breakfast']);
Route::post('/app_mobile/menu_lunch', [App\Http\Controllers\AppMobile\MessAppController::class, 'menu_lunch']);
Route::post('/app_mobile/menu_dinner', [App\Http\Controllers\AppMobile\MessAppController::class, 'menu_dinner']);

Route::post('/app_mobile/dessert_breakfast', [App\Http\Controllers\AppMobile\MessAppController::class, 'dessert_breakfast']);
Route::post('/app_mobile/dessert_lunch', [App\Http\Controllers\AppMobile\MessAppController::class, 'dessert_lunch']);
Route::post('/app_mobile/dessert_dinner', [App\Http\Controllers\AppMobile\MessAppController::class, 'dessert_dinner']);

Route::post('/app_mobile/price_breakfast', [App\Http\Controllers\AppMobile\MessAppController::class, 'price_breakfast']);
Route::post('/app_mobile/price_lunch', [App\Http\Controllers\AppMobile\MessAppController::class, 'price_lunch']);
Route::post('/app_mobile/price_dinner', [App\Http\Controllers\AppMobile\MessAppController::class, 'price_dinner']);

Route::post('/app_mobile/time_breakfast', [App\Http\Controllers\AppMobile\MessAppController::class, 'time_breakfast']);
Route::post('/app_mobile/time_lunch', [App\Http\Controllers\AppMobile\MessAppController::class, 'time_lunch']);
Route::post('/app_mobile/time_dinner', [App\Http\Controllers\AppMobile\MessAppController::class, 'time_dinner']);

Route::post('/app_mobile/save_messing_all', [App\Http\Controllers\AppMobile\MessAppController::class, 'save_messing_all']);
// Messing



// Extra Messing , Tea
Route::post('/app_mobile/extra_messing_names', [App\Http\Controllers\AppMobile\MessAppController::class, 'extra_messing_names']);
Route::post('/app_mobile/extra_messing_price', [App\Http\Controllers\AppMobile\MessAppController::class, 'extra_messing_price']);
Route::post('/app_mobile/extra_messing_save', [App\Http\Controllers\AppMobile\MessAppController::class, 'extra_messing_save']);

Route::post('/app_mobile/tea_names', [App\Http\Controllers\AppMobile\MessAppController::class, 'tea_names']);
Route::post('/app_mobile/tea_price', [App\Http\Controllers\AppMobile\MessAppController::class, 'tea_price']);
Route::post('/app_mobile/tea_save', [App\Http\Controllers\AppMobile\MessAppController::class, 'tea_save']);
// Extra Messing , Tea



// Bar
Route::post('/app_mobile/bar_item_names', [App\Http\Controllers\AppMobile\MessAppController::class, 'bar_item_names']);
Route::post('/app_mobile/bar_item_prices', [App\Http\Controllers\AppMobile\MessAppController::class, 'bar_item_prices']);
// Bar



// Daily Summery Mess Bill
Route::post('/app_mobile/summery_messing', [App\Http\Controllers\AppMobile\DailySummeryAppController::class, 'summery_messing']);
Route::post('/app_mobile/summery_extra_messing', [App\Http\Controllers\AppMobile\DailySummeryAppController::class, 'summery_extra_messing']);
Route::post('/app_mobile/summery_tea', [App\Http\Controllers\AppMobile\DailySummeryAppController::class, 'summery_tea']);
Route::post('/app_mobile/summery_bar', [App\Http\Controllers\AppMobile\DailySummeryAppController::class, 'summery_bar']);

Route::post('/app_mobile/mess_bill_func', [App\Http\Controllers\AppMobile\MessBillAppController::class, 'mess_bill_func']);
// Daily Summery Mess Bill


// Link Generator
Route::get('/app_mobile/gen', [App\Http\Controllers\AppMobile\MessMainController::class, 'gen']);
Route::post('/app_mobile/gen_func', [App\Http\Controllers\AppMobile\MessMainController::class, 'gen_func']);
