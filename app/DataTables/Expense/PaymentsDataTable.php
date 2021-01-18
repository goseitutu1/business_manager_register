<?php

namespace App\DataTables\Expense;

use App\Models\ExpensePayment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class PaymentsDataTable extends DataTable
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
            ->addColumn('payment_date',  function ($row) {
                return $row->payment_date->toFormattedDateString();
            })
            ->addColumn('total_amount',  function ($row) {
                return number_format($row->expense->total_amount, 2);
            })
            ->addColumn('amount_paid',  function ($row) {
                return number_format($row->amount_paid, 2);
            })
            ->addColumn('action', function ($row) {
                return view('expense.payments.actions', ['row' => $row]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\ExpensePayment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ExpensePayment $model)
    {
        $model = $model->where('business_id', session('business_id'))
            ->whereHas('expense', function ($row) {
                $row->where('id', request()->route('expense_id'));
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
            ->setTableId('expenses-table')
            ->columns($this->_getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('csv'),
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
    protected function _getColumns()
    {
        return [
            'payment_date' => ['title' => 'Payment Date'],
            'code',
            'old_balance' => ['title' => 'Old Balance (GH¢)'],
            'amount_paid' => ['title' => 'Paid (GH¢)'],
            'new_balance' => ['title' => 'New Balance (GH¢)'],
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
        return 'expense_payments_' . date('YmdHis');
    }
}
