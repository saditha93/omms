<?php
//
//namespace App\DataTables;
//
//use App\Models\MessMenuItem;
//use Illuminate\Database\Eloquent\Builder as QueryBuilder;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\DB;
//use Yajra\DataTables\EloquentDataTable;
//use Yajra\DataTables\Html\Builder as HtmlBuilder;
//use Yajra\DataTables\Html\Button;
//use Yajra\DataTables\Html\Column;
//use Yajra\DataTables\Html\Editor\Editor;
//use Yajra\DataTables\Html\Editor\Fields;
//use Yajra\DataTables\Services\DataTable;
//
//class MessMenuItemDataTable extends DataTable
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
//            ->addColumn('status',function($row)
//            {
//                $yes = '<span class="badge rounded-pill bg-success">Yes</span>';
//                $no = '<span class="badge rounded-pill bg-danger">No</span>';
//                return $row->status==1?$yes:$no;
//            })
//            ->addColumn('action',function($row)
//            {
//                return '
//                        <a class="btn btn-sm btn-warning" href="'.route('item.edit',$row->id).'">Edit</a>
//                        <form method="POST" action="'.route('item.destroy',$row->id).'" onsubmit="return confirm(\'Are you sure?\');" class="d-inline" >
//                             '.csrf_field().'
//                             '.method_field('DELETE').'
//                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
//                        </form>
//                        ';
//            })
//            ->addColumn('category',function($row)
//            {
//                return $row->MessMenuItemCategory->category_name;
//            })
//            ->setRowId('id')
//            ->rawColumns(['action','status']);
//    }
//
//    /**
//     * Get query source of dataTable.
//     *
//     * @param \App\Models\MessMenuItem $model
//     * @return \Illuminate\Database\Eloquent\Builder
//     */
//    public function query(MessMenuItem $model): QueryBuilder
//    {
//        return $model->newQuery()->with(['messMenuItemCategory'])->whereHas("messMenuItemCategory", function($q){
//            $q->where("mess_id", Auth::user()->mess_id)->orderBy('item_name', 'desc');
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
//                    ->setTableId('messmenuitem-table')
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
//            Column::computed('category'),
//            Column::make('item_name'),
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
//        return 'MessMenuItem_' . date('YmdHis');
//    }
//}
