<?php

namespace App\DataTables\Sales\Payment;

use App\Models\Payment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class PaidDataTable extends DataTable
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
            ->addColumn('created_at',  function ($row) {
                return $row->created_at->toFormattedDateString();
            })
            ->addColumn('sales_no',  function ($row) {
                // TODO: make it an href to point to sales view
                return $row->sales->sales_no;
            })
            ->addColumn('total_tax',  function ($row) {
                return number_format($row->sales->total_tax, 2);
            })
            ->addColumn('total_discount',  function ($row) {
                return number_format($row->discount_value, 2);
            })
            ->addColumn('amount_paid',  function ($row) {
                return number_format($row->amount_paid, 2);
            })
            ->addColumn('overpayment_amount',  function ($row) {
                $val =  number_format($row->overpayment_amount, 2);
                if($val > 0)
                    return "<span style='color: green;'>$val</span>";
                return number_format($row->overpayment_amount, 2);
            })
            ->rawColumns(['overpayment_amount', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\Payment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Payment $model)
    {
        $model = $model->where('business_id', session('business_id'))
            ->where('type', 'paid')
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
            ->setTableId('payments-table')
            ->columns($this->_getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                // Button::make('create'),
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
            'created_at' => ['title' => 'Transaction Date'],
            'sales_no' => ['title' => 'Sales No.'],
            'total_tax' => ['title' => 'Tax (GH¢)'],
            'total_discount' => ['title' => 'Discount (GH¢)'],
            'amount_paid' => ['title' => 'Amount Paid (GH¢)'],
            'overpayment_amount' => ['title' => 'Over Payment (GH¢)'],
            // 'action',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function _filename()
    {
        return 'payments_' . date('YmdHis');
    }
}
