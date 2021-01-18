<?php

namespace App\DataTables\Customer;

use App\Models\Sales;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class TransactionsDataTable extends DataTable
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
            ->addColumn('total_discount',  function ($row) {
                return number_format($row->total_discount, 2);
            })
            ->addColumn('amount_payable',  function ($row) {
                return number_format(@$row->payment->amount_payable, 2);
            })
            ->addColumn('amount_paid',  function ($row) {
                return number_format(@$row->payment->amount_paid, 2);
            })
            ->addColumn('amount_remaining',  function ($row) {
                return number_format(@$row->payment->amount_remaining, 2);
            })
            ->addColumn('action', function ($row) {
                if ($row->inventory_type == "products")
                    return view('sales.product.actions', ['row' => $row]);
                if ($row->inventory_type == "services")
                    return view('sales.service.actions', ['row' => $row]);
                return "N/A";
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
            ->where('customer_id', request()->route('id'))
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
            ->setTableId('customers-table')
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
            'created_at' => ['title' => 'Date Created'],
            'sales_no',
            'amount_payable' => ['title' => 'Total Amount (GH¢)'],
            'amount_paid' => ['title' => 'Amount Paid (GH¢)'],
            'total_discount' => ['title' => 'Discount (GH¢)'],
            'amount_remaining' => ['title' => 'Amount Remaining (GH¢)'],
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
        return 'customers_' . date('YmdHis');
    }
}
