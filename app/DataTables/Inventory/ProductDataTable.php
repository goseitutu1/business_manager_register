<?php

namespace App\DataTables\Inventory;

use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    protected $excludeFromPrint = ["action"];

    protected $excludeFromExport = ["action"];

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
            ->addColumn('expected_profit', function ($row) {
                $val = ($row->selling_price - $row->cost_price) * $row->quantity;
                return number_format($val, 2);
            })
            ->addColumn('selling_price', function ($row) {
                return number_format($row->selling_price, 2);
            })
            ->addColumn('cost_price', function ($row) {
                return number_format($row->cost_price, 2);
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->toFormattedDateString();
            })
            ->addColumn('action', function ($row) {
                return view('inventory.product.actions', ['row' => $row]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Inventory\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        $model = $model->orWhere('business_id', session('business_id'))
                       ->orderBy('updated_at', 'desc');
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('inventory-product-table')
                    ->columns($this->_getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('csv'),
                        Button::make('print'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function _getColumns()
    {
        return [
            'name',
            'quantity',
            'stock_threshold',
            'selling_price' => ['title' => 'Selling Price (GH¢)'],
            'cost_price' => ['title' => 'Cost Price (GH¢)'],
            'expected_profit' => ['title' => 'Expected Profit (GH¢)'],
            'action',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function _filename()
    {
        return 'inventory-product_' . date('YmdHis');
    }
}
