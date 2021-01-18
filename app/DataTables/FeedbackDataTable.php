<?php

namespace App\DataTables;

use App\Models\Feedback;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class FeedbackDataTable extends DataTable
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
            ->addColumn('business', function ($row) {
                return $row->business->name ?? 'N/A';
            })
            ->addColumn('action', function ($row) {
                return view('feedback.actions', ['row' => $row]);
            })->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Feedback $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Feedback $model)
    {
        $model = $model->where('business_id', session('business_id'));
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
            ->setTableId('table')
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
            'business' => ['title' => 'Business Name'],
            'subject',
            'message',
            'status',
            'created_at',
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
        return 'Feedback_' . date('YmdHis');
    }
}
