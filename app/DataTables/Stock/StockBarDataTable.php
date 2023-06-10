<?php

namespace App\DataTables\Stock;

use App\Models\Mess;
use App\Models\Stock\Category;
use App\Models\Stock\Stock;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StockBarDataTable extends DataTable
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
            ->addColumn('establishment', function ($item) {
                return Mess::find($item->establishment_id)->name;
            })->addColumn('measure_unit.name', function ($item) {
                return $item->measure_unit->name . ' (' . $item->measure_unit->size . '' . $item->measure_unit->size_type . ')';
            })
            ->addColumn('action', function ($item) {
                return '<div class="w-80"></div><a href="' . route('stock.show', $item->stock->id) . '" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="bottom" title="Stock Details"><i class="fa fa-eye"></i></a>';
            })->rawColumns(['active', 'action', 'establishment']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Stock $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        $barCat = $model->newQuery()->where('code', 'bar_item')->where('establishment_id', Auth::user()->mess_id)->first();
        return $barCat->items()->with(['stock', 'measure_unit']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('stocks-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(2, 'desc')
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
            Column::make('name')->title("Item Name"),
            Column::make('measure_unit.name')->title("measure_unit"),
            Column::make('stock.qty')->title("Qty"),
            Column::make('stock.shot')->title("Available Shot"),
            Column::make('stock.below_qty')->title("Re-Order level"),
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
        return 'stock_' . date('YmdHis');
    }
}
