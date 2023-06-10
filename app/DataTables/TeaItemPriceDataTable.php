<?php
//
//namespace App\DataTables;
//
//use App\Models\ItemPrices;
//use App\Models\TeaItemPrice;
//use Illuminate\Database\Eloquent\Builder as QueryBuilder;
//use Illuminate\Support\Facades\Auth;
//use Yajra\DataTables\EloquentDataTable;
//use Yajra\DataTables\Html\Builder as HtmlBuilder;
//use Yajra\DataTables\Html\Button;
//use Yajra\DataTables\Html\Column;
//use Yajra\DataTables\Html\Editor\Editor;
//use Yajra\DataTables\Html\Editor\Fields;
//use Yajra\DataTables\Services\DataTable;
//
//class TeaItemPriceDataTable extends DataTable
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
//            ->addColumn('itemName',function($row)
//            {
//
//                return $row->messMenuItem->item_name ;
//            })
//            ->addColumn('status',function($row)
//            {
//                $yes = '<span class="badge rounded-pill bg-success">Yes</span>';
//                $no = '<span class="badge rounded-pill bg-danger">No</span>';
//                return $row->status==1?$yes:$no;
//            })
//            ->addColumn('action',function($row)
//            {
//                return '
//                        <a class="btn btn-sm btn-warning" href="'.route('tea-item-edit',$row->id).'">Edit</a>
//                        <form method="POST" action="" onsubmit="return confirm(\'Are you sure?\');" class="d-inline" >
//                             '.csrf_field().'
//                             '.method_field('DELETE').'
//                            <button class="btn btn-danger btn-sm" disabled type="submit">Delete</button>
//                        </form>
//                        ';
//            })
//            ->addColumn('itemPrice',function($row)
//            {
//                $formated = sprintf('%0.2f', $row->price);
//                return $formated;
//            })
//            ->rawColumns(['action','status','itemName','itemPrice'])
//            ->setRowId('id');
//    }
//
//    /**
//     * Get query source of dataTable.
//     *
//     * @param \App\Models\TeaItemPrice $model
//     * @return \Illuminate\Database\Eloquent\Builder
//     */
//    public function query(ItemPrices $model): QueryBuilder
//    {
////        return $model->newQuery()->join('mess_menu_items','mess_menu_items.id','item_prices.item_id')
////            ->where('mess_menu_items.category_id','2');
//
//        return $model->newQuery()->with(['messMenuItem'])->whereHas("messMenuItem", function($q){
//            $q->where('mess_menu_items.category_id','4')->where('mess_id',Auth::user()->mess_id)
//            ->orderBy('id','desc');
//        });
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
//                    ->setTableId('teaitemprice-table')
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
//            Column::make('DT_RowIndex')->searchable(false)->orderable(false)->title('Serial')
//                ->width(110),
//            Column::make('itemName'),
//            Column::make('date')->title('Crated at'),
//            Column::make('scale'),
//            Column::computed('itemPrice'),
//            Column::computed('status')
//                ->width(130),
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
//        return 'TeaItemPrice_' . date('YmdHis');
//    }
//}
