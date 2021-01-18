<?php

namespace App\DataTables\Account;

use App\Models\GLAccount;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class GLDataTable extends DataTable
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
                return '';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\GLAccount $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(GLAccount $model)
    {
        $model = $model::orderBy('updated_at', 'desc');
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
            ->setTableId('services-sales-table')
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
            'name' => ['title' => 'Name'],
            'created_at' => ['title' => ''],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function _filename()
    {
        return 'gl-accounts_' . date('YmdHis');
    }
}
