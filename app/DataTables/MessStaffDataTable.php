<?php

namespace App\DataTables;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MessStaffDataTable extends DataTable
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
            ->addColumn('action', function ($item) {
                return '<div class="w-80"></div><a href="' . route('reports.staff', $item->id) . '" class="btn btn-xs btn-warning"><i class="fa fa-eye"></i></a>
                </div>';
            })->addColumn('establishment', function ($item) {
                return $item->establishments->establishment;
            })
            ->addColumn('roles', function ($item) {
                if($item->userTypes->user_type == 'mess-manager') {
                    return '<label class="badge badge-success">Mess Manager</label>';
                }else{
                    return '<label class="badge badge-success">' . $item->getRoleNames()->first() . '</label>';
                }
            })
            ->rawColumns(['action', 'establishment', 'roles']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Admin $model)
    {
        return $model->newQuery()->where('mess_id', Auth::user()->mess_id)->orderBy('id','ASC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
            Column::make('name')->title("Name"),
            Column::make('email')->title("E Number"),
            Column::computed('establishment')->title("Establishment"),
            Column::computed('roles')->title("Roles"),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
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
        return 'user_' . date('YmdHis');
    }
}
