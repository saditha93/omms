<?php

namespace App\DataTables\Stock;

use App\Models\Stock\MeasureUnit;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MeasureUnitDataTable extends DataTable
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
            ->addColumn('active', function ($item) {
                if ($item->active == 1) {
                    return '<mark class="px-2 text-white bg-green-600 rounded dark:bg-green-500">active</mark>';
                } else {
                    return '<mark class="px-2 text-white bg-danger rounded dark:bg-danger">deactivate</mark>';
                }
            })
            ->editColumn('categories', function ($item) {
                $categoryName = [];
                foreach ($item->categories()->get() as $category) {
                    $categoryName[] = $category->name;
                }
                return implode(", ", $categoryName);
            })->editColumn('active', function ($item) {
                if ($item->active == 1) {
                    return '<mark class="px-2 text-white bg-green-600 rounded dark:bg-green-500">active</mark>';
                } else {
                    return '<mark class="px-2 text-white bg-danger rounded dark:bg-danger">deactivate</mark>';
                }
            })
            ->addColumn('action', function ($item) {
                return '<div class="w-80"></div><a href="' . route('measureUnit.show', $item->id) . '" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="bottom" title="Measure Unit Details"><i class="fa fa-eye"></i></a>
                <a href="' . route('measureUnit.edit', $item->id) . '" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="bottom" title="Measure Unit Edit"><i class="fa fa-pen"></i></a>
                <form  action="' . route('measureUnit.destroy', $item->id) . '" method="POST" class="d-inline" >
               ' . csrf_field() . '
                   ' . method_field("DELETE") . '
               <button type="submit"  class="btn bg-danger btn-xs  dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700" onclick="return confirm(\'Do you need to delete this\');" data-toggle="tooltip" data-placement="bottom" title="Measure Unit Delete">
               <i class="fa fa-trash-alt"></i></button>
               </form> </div>';
            })->rawColumns(['active', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MeasureUnit $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MeasureUnit $model)
    {
            return $model->newQuery()->with('establishment')->where('establishment_id', Auth::user()->mess_id)->whereNull('size_type');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('measure_units-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
            Column::make('name')->title("Name"),
            Column::make('abbreviation')->title("Abbreviation"),
            Column::computed('categories')->title("Categories"),
//            Column::make('establishment.name')->title("Establishment"),
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
        return 'measureUnit_' . date('YmdHis');
    }
}
