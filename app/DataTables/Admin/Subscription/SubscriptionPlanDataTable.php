<?php

namespace App\DataTables\Admin\Subscription;

use App\Models\SubscriptionPlan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class SubscriptionPlanDataTable extends DataTable
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
            ->addColumn('subscriptions', function ($row) {
                return $row->subscriptions->count();
            })
            ->addColumn('employees', function ($row) {
                $prefix = $row->has_employees_limit ? "+" : "";
                return $row->minimum_employees . " - " . $row->maximum_employees . "" . $prefix;
            })
            ->addColumn('action', function ($row) {
                return view('admin.subscription.actions', ['row' => $row]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\SubscriptionPlan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SubscriptionPlan $model)
    {
        //TODO!: Add roles list
        $model = $model->orderBy('updated_at', 'desc');
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
        // TODO: add number of employees
        return [
            'name',
            'price',
            'employees',
            'description',
            'subscriptions',
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
        return 'subscription_plans_' . date('YmdHis');
    }
}
