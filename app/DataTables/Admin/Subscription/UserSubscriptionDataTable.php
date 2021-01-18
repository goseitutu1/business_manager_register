<?php

namespace App\DataTables\Admin\Subscription;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class UserSubscriptionDataTable extends DataTable
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
            ->addColumn('name', function ($row) {
                return $row->subscription->plan->name ?? "N/A";
            })
            ->addColumn('last_payment', function ($row) {
                return $row->subscription->last_payment_date ?? 'N/A';
            })
            ->addColumn('expiry_date', function ($row) {
                return $row->subscription->expiry_date ?? 'N/A';
            })
            ->addColumn('days_remaining', function ($row) {
                $date = $row->subscription->last_payment_date;
                if (empty($date)) {
                    return "N/A";
                }
                $expiry_date = $row->subscription->expiry_date;
                if (now()->gte($expiry_date)) {
                    return $date->diffInDays($expiry_date) . ' days ago';
                }
                return $date->diffInDays($expiry_date) . ' ago';
            })
            ->addColumn('payment_history',  function ($row) {
                if (!isset($row->subscription_id)) {
                    return "N/A";
                }
                $url = route('admin.subscription.payment.history', ['subscriptionId' => $row->subscription_id]);
                return "<a href='$url'>Payment History</a>";
            })
            ->rawColumns(['payment_history']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $model = $model->where('type', 'manager')
            ->where('subscription_id', '!=', null)
            ->orderBy('updated_at', 'desc')
            ->with(['subscription']);
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
            'name',
            'last_payment',
            'expiry_date',
            'days_remaining',
            'payment_history',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function _filename()
    {
        return 'user_subscription_' . date('YmdHis');
    }
}
