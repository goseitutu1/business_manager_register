<?php

namespace App\DataTables\Admin;

use App\Models\FAQ;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class FAQDataTable extends DataTable
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
            ->addColumn('action', function ($row) {
                return view('admin.faq.actions', ['row' => $row]);
            })->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App/Models\FAQDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FAQDataTable $model)
    {
        $model = FAQ::query()->select('id', 'question', 'answer');
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
            ->setTableId('faqdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('print'),
                Button::make('reset'),
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
            'question',
            'answer',
            'action'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'FAQ_' . date('YmdHis');
    }
}
