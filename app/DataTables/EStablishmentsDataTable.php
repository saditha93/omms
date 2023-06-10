<?php

namespace App\DataTables;

use App\Models\EStablishment;
use App\Models\Establishments;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EStablishmentsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action',function($row)
            {
                return '
                        <a class="btn btn-dark btn-sm btn-default" href="'.route('establishment.edit',$row->id).'"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="'.route('establishment.destroy',$row->id).'" onsubmit="return confirm(\'Are you sure?\');" class="d-inline" >
                             '.csrf_field().'
                             '.method_field('DELETE').'
                            <button class="btn btn-dark btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                        </form>
                        ';
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\EStablishment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Establishments $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('id', 'asc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('establishments-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
//                        Button::make('excel'),
//                        Button::make('csv'),
//                        Button::make('pdf'),
//                        Button::make('print'),
//                        Button::make('reset'),
//                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [

            Column::make('DT_RowIndex')->searchable(false)->orderable(false)->title('Serial')
                ->width(110),
            Column::make('establishment'),
            Column::make('abbr')->title('Abbreviation'),
            Column::computed('action')
                ->width(70)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'EStablishments_' . date('YmdHis');
    }
}
