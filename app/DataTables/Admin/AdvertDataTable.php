<?php

namespace App\DataTables\Admin;

use App\Models\Advert;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class AdvertDataTable extends DataTable
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
            ->addColumn('price', function ($row) {
                return number_format($row->price, 2);
            })
            ->addColumn('action', function ($row) {
                return view('admin.advert.actions', ['row' => $row]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\Advert $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Advert $model)
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
            'status',
            'price',
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
        return 'users_' . date('YmdHis');
    }
}
