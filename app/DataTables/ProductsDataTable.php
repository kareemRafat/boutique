<?php

namespace App\DataTables;

use Livewire\Livewire;
use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ProductsDataTable extends DataTable
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
            ->addColumn('action', 'admin.buttons.products-group')
            ->addColumn('price', function(Product $product){
                return "$". number_format($product->price/100, 2)  ;
            })
            ->addColumn('stock', function(Product $product){
                return $product -> pro_stock  ;
            })
            ->addColumn('cat_id', function(Product $product){
                return $product -> category -> name  ;
            })
            ->addColumn('created_at', function(Product $product){
                return $product -> created_at -> diffForHumans() ;
            })
            ->rawColumns(['stock' , 'action']) // to not escape tags
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model): QueryBuilder
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
                    ->setTableId('products-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->orderBy(0 , 'ASC') // to sort id asc
                    ->parameters([
                        'order' => [0,'asc'],
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
            Column::make('price'),
            Column::make('stock'),
            Column::make('cat_id')->title('Category'),
            Column::make('created_at'),

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
        return 'Products_' . date('YmdHis');
    }
}
