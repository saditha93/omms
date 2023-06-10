<?php

namespace App\DataTables\Stock;

use App\Models\Stock\IssueHeader;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class IssueDataTable extends DataTable
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
            ->editColumn('establishment', function ($item) {
                if (isset($item->establishment->name)) {
                    return $item->establishment->name;
                } else {
                    return 'No';
                }
            })
            ->addColumn('action', function ($item) {
                if ($item->active == 2) {
                    return '<div class="w-80"></div><a href="' . route('issueHeader.show', $item->id) . '" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="bottom" title="Issue Note Details"><i class="fa fa-eye"></i></a>
                </div>';
                } else {
                    return '<div class="w-80"></div><a href="' . route('issueHeader.show', $item->id) . '" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="bottom" title="Issue Note Details"><i class="fa fa-eye"></i></a>
                        <a href="' . route('issueDetail.create', 'id=' . $item->id) . '" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="bottom" title="Add items to Issue Note"><i class="fa fa-check-square"></i></a>
                <a href="' . route('issueHeader.edit', $item->id) . '" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="bottom" title="Issue Note Edit"><i class="fa fa-pen"></i></a>
                </div>';
                }
            })->rawColumns(['active', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\IssueHeader
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(IssueHeader $model)
    {
        return $model->newQuery()->with('establishment')->where('establishment_id', Auth::user()->mess_id);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('IssueDetails-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->scrollX(true)
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
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
            Column::make('no')->title("Issue Order No"),
            Column::make('order_no')->title("Issue No"),
            Column::make('service_no')->title("Request And Issue To"),
            Column::make('date')->title("Issue Date"),
            Column::computed('remarks')->title("Issue Reason"),
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
        return 'issue_' . date('YmdHis');
    }
}
