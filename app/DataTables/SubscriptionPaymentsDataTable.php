<?php

namespace App\DataTables;

use App\Models\SubscriptionPayment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class SubscriptionPaymentsDataTable extends DataTable
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
            ->addColumn('amount',  function ($row) {
                return $row->amount;
            })
            ->addColumn('expiry_date',  function ($row) {
                return  $row->subscription->expiry_date;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\SubscriptionPayment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SubscriptionPayment $model)
    {
        $model = $model->where('user_id', '=', auth()->user()->id)
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
            ->setTableId('subscription-table')
            ->columns($this->_getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
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
            'payment_date',
            'expiry_date',
            'amount',
            'mobile_money_number',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function _filename()
    {
        return 'subscription_payments_' . date('YmdHis');
    }
}
