<?php

namespace App\DataTables\Customer;

use App\Models\Customer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class CustomerDataTable extends DataTable
{
    protected $excludeFromPrint = ["action"];

    protected $excludeFromExport = ["action"];

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
            ->addColumn('full_name',  function ($row) {
                return $row->full_name;
            })
            ->addColumn('added_by',  function ($row) {
                return $row->employee->full_name ?? "N/A";
            })
            ->addColumn('branch',  function ($row) {
                return $row->business->name;
            })
            ->addColumn('transactions',  function ($row) {
                $url = route('customer.transactions', ['id' => $row->id]);
                return "<a href='$url'>View Transactions</a>";
            })
            ->addColumn('action', function ($row) {
                return view('customer.actions', ['row' => $row]);
            })
            ->rawColumns(['transactions', 'action'])
            ->filterColumn('full_name', function ($query, $keyword) {
                $query->orWhere('first_name', 'like', '%' . $keyword . '%');
                $query->orWhere('last_name', 'like', '%' . $keyword . '%');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\Customer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model)
    {
        $model = $model->where('business_id', session('business_id'))
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
            ->columns($this->getColumns())
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
    protected function getColumns()
    {
        return [
            'full_name',
            'phone_number',
            'added_by',
            'branch',
            'transactions',
            'created_at' => ['title' => 'Date Created'],
            'action',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'customers_' . date('YmdHis');
    }
}
