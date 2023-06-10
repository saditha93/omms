<?php

namespace App\DataTables;

use App\Models\Mess;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MessesDataTable extends DataTable
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
            ->addColumn('action',function($row)
            {
                return '
                        <a class="btn btn-sm btn-warning btn-dark" href="'.route('mess.edit',$row->id).'"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="'.route('mess.destroy',$row->id).'" onsubmit="return confirm(\'Are you sure?\');" class="d-inline" >
                             '.csrf_field().'
                             '.method_field('DELETE').'
                            <button class="btn btn-danger btn-sm btn-dark" type="submit"><i class="fa fa-trash"></i></button>
                        </form>
                        ';
            })
            ->addColumn('establishment',function($row)
            {
                return $row->establishments->establishment;
            })
            ->rawColumns(['action','establishment'])
            ->setRowId('code');
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Mess $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Mess $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('messes-table')
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
//            Column::computed('action')
//                  ->exportable(false)
//                  ->printable(false)
//                  ->width(60)
//                  ->addClass('text-center'),
            Column::computed('establishment'),
            Column::make('name')->title('Mess Name'),
            Column::make('location'),
            Column::make('code'),
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
        return 'Messes_' . date('YmdHis');
    }
}
