<?php

namespace App\DataTables\Admin\Report;

use App\Models\AdvertPayment;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class AdvertPaymentDataTable extends DataTable
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
            ->addColumn('status', function ($row) {
                return ucwords($row->status->name ?? "N/A");
            })
            ->addColumn('author', function ($row) {
                // $name = User::where('email', $row->advert->author)->first()->full_name;
                return $row->advert->author;
            })
            ->addColumn('title', function ($row) {
                return ucwords($row->advert->title ?? "N/A");
            })
            ->addColumn('amount', function ($row) {
                return number_format($row->amount, 2);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\AdvertPayment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AdvertPayment $model)
    {
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
        return [
            'title',
            'author',
            'amount' => ['title' => 'Amount Paid'],
            'mobile_money_number',
            'status',
            'created_at' => ['title' => 'Payment Date'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function _filename()
    {
        return 'advert-payments-report_' . date('YmdHis');
    }
}
