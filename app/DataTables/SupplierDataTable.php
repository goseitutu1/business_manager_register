<?php

namespace App\DataTables;

use App\Models\Vendor;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class SupplierDataTable extends DataTable
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
            ->addColumn('full_name', function ($row) {
                return $row->full_name;
            })
            ->addColumn('email', function ($row) {
                return $row->email ?? "N/A";
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->toFormattedDateString();
            })
            ->addColumn('action', function ($row) {
                return view('supplier.actions', ['row' => $row]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\Vendor $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Vendor $model)
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
                    ->setTableId('supplier-table')
                    ->columns($this->_getColumns())
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
    protected function _getColumns()
    {
        return [
            'full_name',
            'email',
            'phone_number',
            'location',
            'description',
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
        return 'suppliers_' . date('YmdHis');
    }
}
