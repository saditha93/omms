<?php

namespace App\DataTables;

use App\Models\MessMenuItemCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MessMenuItemCategoryDataTable extends DataTable
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
//            ->addColumn('action',function($row)
//            {
//                if (Auth::user()->user_type == 1)
//                {
//                    return '
//                        <a class="btn btn-sm btn-warning" href="'.route('category.edit',$row->id).'">Edit</a>
//                        <form method="POST" action="'.route('category.destroy',$row->id).'" onsubmit="return confirm(\'Are you sure?\');" class="d-inline" >
//                             '.csrf_field().'
//                             '.method_field('DELETE').'
//                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
//                        </form>
//                        ';
//                }
//                else
//                {
//                    return '
//                        <button class="btn btn-sm btn-warning" disabled href="">Edit</button>
//                        <button class="btn btn-danger btn-sm" disabled type="submit">Delete</button>
//                        ';
//                }
//
//            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MessMenuItemCategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MessMenuItemCategory $model): QueryBuilder
    {
        if(isset(Auth::user()->mess_id))
        {
            return $model->newQuery()->orderBy('created_at', 'asc')
                ;

        }
        else
        {
            return $model->newQuery();
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('messmenuitemcategory-table')
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

            Column::make('DT_RowIndex')->searchable(false)->orderable(false)->title('Serial')
                ->width(110),
            Column::make('category_name'),
//            Column::computed('action')
//                ->width(110)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'MessMenuItemCategory_' . date('YmdHis');
    }
}
