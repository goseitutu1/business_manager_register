<?php

namespace App\DataTables\Sales;

use App\Models\Sales;
use Yajra\DataTables\Html\Button;
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
            ->addColumn('created_at', function ($row) {
                return $row->created_at;
            })
            ->addColumn('total_discount', function ($row) {
                return number_format($row->total_discount, 2);
            })
            ->addColumn('amount_payable', function ($row) {
                return number_format(@$row->payment->total_amount, 2);
            })
            ->addColumn('amount_paid', function ($row) {
                return number_format(@$row->payment->amount_paid, 2);
            })
            ->addColumn('change', function ($row) {
                if (preg_match('/credit/i', $row->type)) {
                    return number_format(0 - @$row->payment->amount_remaining, 2);
                }
                return number_format(@$row->payment->amount_remaining, 2);
            })
            ->addColumn('attendant', function ($row) {
                return $row->attendant->full_name ?? "N/A";
            })
            ->addColumn('action', function ($row) {
                return view('sales.product.actions', ['row' => $row]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\Sales $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Sales $model)
    {
        $model = $model->where('business_id', session('business_id'))
                       ->whereHas('items', function ($row) {
                           $row->where('product_id', '!=', null);
                       })
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
                    ->setTableId('services-sales-table')
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
            'created_at' => ['title' => 'Date'],
            'sales_no' => ['title' => 'Sales No.'],
            'total_discount' => ['title' => 'Discount (GH¢)'],
            'amount_payable' => ['title' => 'Total Amount (GH¢)'],
            'amount_paid' => ['title' => 'Amount Paid (GH¢)'],
            'change',
            'attendant',
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
        return 'sales-product_' . date('YmdHis');
    }
}
