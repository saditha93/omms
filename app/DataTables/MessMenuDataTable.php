<?php

namespace App\DataTables;

use App\Models\MessMenu;
use App\Models\MessMenuDetails;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MessMenuDataTable extends DataTable
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
            ->addColumn('action', 'messmenu.action')
            ->addColumn('action',function($row)
            {
                return '
                        <a class="btn btn-sm btn-warning" href="'.route('menu.edit',$row->id).'">Edit</a>
                        <form method="POST" action="'.route('menu.destroy',$row->id).'" onsubmit="return confirm(\'Are you sure?\');" class="d-inline" >
                             '.csrf_field().'
                             '.method_field('DELETE').'
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                        ';
            })
            ->addColumn('status',function($row)
            {
                $yes = '<span class="badge rounded-pill bg-success">Yes</span>';
                $no = '<span class="badge rounded-pill bg-danger">No</span>';
                return $row->status==1?$yes:$no;
            })
            ->addColumn('meal_type',function($row)
            {
                $veg = '<span class="badge rounded-pill bg-success">Vegetarian</span>';
                $nonVeg = '<span class="badge rounded-pill bg-danger">Non-vegetarian</span>';
                return $row->meal_type==1?$nonVeg:$veg;
            })
            ->addColumn('menu-item',function($row)
            {

                $items = DB::table('mess_menus')
                    ->join('mess_menu_items','mess_menu_items.id','=','mess_menus.item_id')
                ->where('mess_menus.mess_menu_id', $row->id)
                ->where('mess_menus.mess_id', Auth::user()->mess_id)
                ->get('item_name');

                $menuItems = array();
                foreach ($items as $item)
                {
                    $itemElement = '<span class="badge badge-info">'.$item->item_name.'</span>&nbsp;';
                    array_push($menuItems,$itemElement);
                }

                return '<h4>'.str_replace( ',', '',implode(",",$menuItems)).'</h4>';
            })
            ->rawColumns(['action','menu-item','meal_type','status'])
            ->setRowId('mess_menu_id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MessMenu $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MessMenuDetails $model): QueryBuilder
    {

        return $model->newQuery()->with(['messMenu'])->whereHas("messMenu", function($q){
            $q->where('mess_menus.mess_id',Auth::user()->mess_id);
        });

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('messmenu-table')
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
//                  ->addClass('text-center'),3

            Column::make('DT_RowIndex')->searchable(false)->orderable(false)->title('Serial')
                ->width(80),
            Column::make('menu_name'),
//            Column::make('menu_type'),
            Column::computed('meal_type'),
            Column::computed('status')
                ->width(80),
            Column::computed('menu-item'),
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
        return 'MessMenu_' . date('YmdHis');
    }
}
