<?php

namespace App\DataTables;

use App\Models\Business;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
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
                return $row->name;
            })
            ->addColumn('action', function ($row) {
                return view('business.actions', ['row' => $row]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\Business $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Business $model)
    {
        $model = $model->where('owner_id', auth()->user()->id)
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
            'name',
            'created_at',
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
        return 'businesses_' . date('YmdHis');
    }
}
