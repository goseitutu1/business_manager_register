<?php

namespace App\DataTables\Admin\Business;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class BusinessDataTable extends DataTable
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
            ->addColumn('name',  function ($row) {
                return $row->full_name;
            })
            ->addColumn('branches',  function ($row) {
                $total = $row->businesses()->count();
                $url = route('admin.business.branches', ['ownerId' => $row->id_hash]);
                return "<a href='$url'>$total</a>";
            })
            ->addColumn('subscription',  function ($row) {
                $name = $row->subscription->plan->name ?? "No Subscription";
                $url = route('admin.subscription.plan.index');
                return "<a href='$url'>$name</a>";
            })
            ->rawColumns(['branches', 'subscription', 'action']);
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
            ->setTableId('business-table')
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
            'email',
            'phone_number' => ['title' => 'Phone'],
            'advert_source',
            'branches',
            'subscription',
            'created_at',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function _filename()
    {
        return 'businesses_' . date('YmdHis');
    }
}
