<?php

namespace App\DataTables\Stock;

use App\Models\Stock\GRNHeader;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GRNBarDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('active', function ($item) {
                if ($item->active == 1) {
                    return '<mark class="px-2 text-white bg-green-600 rounded dark:bg-green-500">active</mark>';
                } elseif ($item->active == 2) {
                    return '<mark class="px-2 text-white bg-danger rounded dark:bg-danger">closed</mark>';
                } else {
                    return '<mark class="px-2 text-white bg-danger rounded dark:bg-danger">deactive</mark>';
                }
            })
            ->editColumn('supplier.name', function ($item) {
                return '<a href="' . route('supplier.show', $item->supplier->id) . '">
                                <span>' . $item->supplier->name . '</span></a>';
            })
            ->addColumn('action', function ($item) {
                if ($item->active == 2) {
                    return '<div class="w-80"></div><a href="' . route('gRNHeader.show', $item->id) . '" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="bottom" title="Good Recive Note Details"><i class="fa fa-eye"></i></a>
                </div>';
                } else {
                    return '<div class="w-80"></div><a href="' . route('gRNHeader.show', $item->id) . '" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="bottom" title="Good Recive Note Details"><i class="fa fa-eye"></i></a>
                        <a href="' . route('bar.grn.item', 'id=' . $item->id) . '" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="bottom" title="Add Items to Good Recive Note"><i class="fa fa-check-square"></i></a>
                <a href="' . route('gRNHeader.edit', $item->id) . '" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="bottom" title="Good Recive Note Edit"><i class="fa fa-pen"></i></a>
                </div>';
                }
            })->rawColumns(['active', 'action','supplier.name']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\GRNHeader
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(GRNHeader $model)
    {
        return $model->newQuery()->with('establishment', 'supplier')->where('establishment_id', Auth::user()->mess_id)->where('is_bar',1);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('GRNHeaders-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->scrollX(true)
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('#')->searchable(false)->orderable(false),
            Column::make('no')->title("Bill No"),
            Column::make('date')->title("GRN Date"),
            Column::make('order_no')->title("GRN No"),
            Column::make('supplier.name')->title("Supplier"),
            Column::make('remarks')->title("Remark"),
            Column::make('active')->title("Status"),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'g_r_n_' . date('YmdHis');
    }
}
