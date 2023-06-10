<?php
//
//namespace App\DataTables;
//
//use App\Models\MessDailyRation;
//use App\Models\MessDailyRations;
//use App\Models\MessMenuItem;
//use Carbon\Carbon;
//use Illuminate\Database\Eloquent\Builder as QueryBuilder;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\DB;
//use function Ramsey\Uuid\Lazy\toString;
//use function Spatie\Ignition\ErrorPage\jsonEncode;
//use function Symfony\Component\Mime\Header\get;
//use Yajra\DataTables\EloquentDataTable;
//use Yajra\DataTables\Html\Builder as HtmlBuilder;
//use Yajra\DataTables\Html\Button;
//use Yajra\DataTables\Html\Column;
//use Yajra\DataTables\Html\Editor\Editor;
//use Yajra\DataTables\Html\Editor\Fields;
//use Yajra\DataTables\Services\DataTable;
//
//class MessDailyRationDataTable extends DataTable
//{
//    /**
//     * Build DataTable class.
//     *
//     * @param QueryBuilder $query Results from query() method.
//     * @return \Yajra\DataTables\EloquentDataTable
//     */
//    public function dataTable(QueryBuilder $query): EloquentDataTable
//    {
//        return (new EloquentDataTable($query))
//            ->addIndexColumn()
//            ->addColumn('action',function($row)
//            {
//                return '
//                        <a class="btn btn-sm btn-warning" href="/admin/ration/'.$row->id.'/edit">Edit</a>
//                        <form method="POST" action="'.route('ration.destroy',$row->id).'" onsubmit="return confirm(\'Are you sure?\');" class="d-inline" >
//                             '.csrf_field().'
//                             '.method_field('DELETE').'
//                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
//                        </form>
//                        ';
//            })
//            ->addColumn('menu',function($row)
//            {
//                return $row->messDaiyRationItem->menu_name;
//            })
//            ->addColumn('type',function($row)
//            {
//                $veg = '<span class="badge rounded-pill bg-success">Vegetarian</span>';
//                $nonveg = '<span class="badge rounded-pill bg-info">Non-vegetarian</span>';
//                return $row->messDaiyRationItem->meal_type==1?$nonveg:$veg;
//
//            })
//            ->addColumn('menu_type',function($row)
//            {
//                return $row->messDaiyRationItem->menu_type;
//
//            })
//            ->addColumn('dessert',function($row)
//            {
//                $dessert = MessMenuItem::where('id',$row->dessert)
//                    ->select('item_name')
//                    ->first();
//
//                return (isset($dessert->item_name)?$dessert->item_name:'<span class="badge rounded-pill bg-danger">Not added</span>');
////              return isset($dessert['item_name'])?$dessert['item_name']:'<span class="text-danger">Not Added</span>';
//
//            })
//            ->rawColumns(['action','dessert','type'])
//            ->setRowId('id');
//    }
//
//    /**
//     * Get query source of dataTable.
//     *
//     * @param \App\Models\MessDailyRation $model
//     * @return \Illuminate\Database\Eloquent\Builder
//     */
//    public function query(MessDailyRations $model): QueryBuilder
//    {
//        return $model->newQuery()->where('mess_id',`Auth::user()->mess_id`)
//            ->where('date',  Carbon::today()->toDateString());
//    }
//
//    /**
//     * Optional method if you want to use html builder.
//     *
//     * @return \Yajra\DataTables\Html\Builder
//     */
//    public function html(): HtmlBuilder
//    {
//        return $this->builder()
//                    ->setTableId('messdailyration-table')
//                    ->columns($this->getColumns())
//                    ->minifiedAjax()
//                    //->dom('Bfrtip')
//                    ->orderBy(1)
//                    ->selectStyleSingle()
//                    ->buttons([
//                        Button::make('excel'),
//                        Button::make('csv'),
//                        Button::make('pdf'),
//                        Button::make('print'),
//                        Button::make('reset'),
//                        Button::make('reload')
//                    ]);
//    }
//
//    /**
//     * Get the dataTable columns definition.
//     *
//     * @return array
//     */
//    public function getColumns(): array
//    {
//        return [
////            Column::computed('action')
////                  ->exportable(false)
////                  ->printable(false)
////                  ->width(60)
////                  ->addClass('text-center'),
//            Column::make('DT_RowIndex')->searchable(false)->orderable(false)->title('Serial')
//                ->width(110),
//            Column::computed('menu'),
//            Column::computed('type'),
//            Column::computed('menu_type'),
//            Column::computed('dessert'),
//            Column::make('date'),
//            Column::make('tentative_price'),
////            Column::make('meal_time'),
//            Column::computed('action')
//                ->width(110)
//        ];
//    }
//
//    /**
//     * Get filename for export.
//     *
//     * @return string
//     */
//    protected function filename(): string
//    {
//        return 'MessDailyRation_' . date('YmdHis');
//    }
//}
