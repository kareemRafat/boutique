<?php

namespace App\DataTables;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->addColumn('action' , function(Admin $admin){
                if($admin -> verified == 1) {
                   return "<button class='btn btn-danger btn-sm'>deactivate</button>";
                } else {
                   return "<button class='btn btn-primary btn-sm'>Activate</button>";
                }
           })
            ->addColumn('verified', function(Admin $admin){
                if($admin -> verified == 1) {
                   return "<i class='fas fa-user-check'></i>";
                } else {
                   return "<i class='fas fa-user-slash'></i>";
                }
           })
            ->addColumn('created_at', function(Admin $admin){
                return $admin ->created_at -> diffForHumans();
            })
            ->addColumn('updated_at', function(Admin $admin){
                return $admin ->updated_at -> diffForHumans();
            })
            ->rawColumns(['verified' , 'action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Admin $model): QueryBuilder
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
                    ->setTableId('admins-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->orderBy(1)
                    ->parameters([
                        'order' => [0,'asc'] ,
                        "language"=> [
                            // when table is empty and no search data
                            "emptyTable" => "No Admins registered",
                            "zeroRecords" => "No records found"
                        ]
                    ])
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
    protected function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('verified'),
            Column::make('created_at')->title('Created'),
            Column::make('updated_at')->title('Updated'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Admins_' . date('YmdHis');
    }
}
