<?php

namespace App\DataTables\Sales\Payment;

use App\Models\Payment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class OwingDataTable extends DataTable
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
            ->addColumn('amount_owed',  function ($row) {
                return number_format($row->amount_owed, 2);
            })
            ->addColumn('amount_paid',  function ($row) {
                return number_format($row->amount_paid, 2);
            })
            ->addColumn('amount_remaining',  function ($row) {
                return number_format($row->amount_remaining, 2);
            })
            ->addColumn('sale_status',  function ($row) {
                $salestate = number_format($row->amount_remaining, 2);
                if($salestate == 0){
                    return '<span class="badge badge-success">Closed Sale</span>';
                }
                else{
                    return '<span class="badge badge-danger">Credit Sale</span>';
                }
            })
            ->addColumn('action', function ($row) {
                $salestate = number_format($row->amount_remaining, 2);
                if($salestate == 0){
                    return '<span class="badge badge-success">Closed</span>';
                }
                else{
                    return view('sales.payment.owing.actions', ['row' => $row]);
                }
            })->rawColumns(['action','sale_status']);
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
//            ->where('type', 'regexp', 'partial|owing')
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
            'total_discount' => ['title' => 'Discount (GH¢)'],
            'amount_owed' => ['title' => 'Amount Owing (GH¢)'],
            'amount_paid' => ['title' => 'Amount Paid (GH¢)'],
            'amount_remaining' => ['title' => 'Amount Remaining (GH¢)'],
            'sale_status' => ['title' => 'Status'],
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
        return 'payments_' . date('YmdHis');
    }
}
