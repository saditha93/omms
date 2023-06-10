<?php

namespace App\DataTables;

use App\Models\Admin;
use App\Models\MessManager;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MessManagersDataTable extends DataTable
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
                        <a class="btn btn-sm btn-warning" href="'.route('mess-manager-edit',$row->id).'">Edit</a>
                        <form method="POST" action="'.route('mess.destroy',$row->id).'" onsubmit="return confirm(\'Are you sure?\');" class="d-inline" >
                             '.csrf_field().'
                             '.method_field('DELETE').'
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                        ';
            })
            ->addColumn('establishment',function($row)
            {
                return $row->establishments->establishment;
            })
            ->addColumn('usertype',function($row)
            {
                return $row->userTypes->user_type;
            })
            ->rawColumns(['action','establishment','usertype'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MessManager $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Admin $model): QueryBuilder
    {
        return $model->newQuery()->where('user_type',2);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('messmanagers-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
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
            Column::make('name'),
            Column::make('email'),
            Column::computed('establishment'),
            Column::computed('usertype'),
            Column::computed('action')
                ->width(110)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'MessManagers_' . date('YmdHis');
    }
}
