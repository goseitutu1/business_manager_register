<?php

namespace App\DataTables\Admin\Subscription;

use App\Models\SubscriptionPayment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class PaymentHistoryDataTable extends DataTable
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
            ->eloquent($query);
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\SubscriptionPayment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SubscriptionPayment $model)
    {
        $model = $model->where('subscription_id', request()->route('subscriptionId', null))
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
            ->setTableId('users-table')
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
        return 'subscription_payments_history_' . date('YmdHis');
    }
}
