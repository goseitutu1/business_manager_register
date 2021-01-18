<?php

namespace App\DataTables\Admin;

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
            ->addColumn('customer', function ($row) {
                return $row->created_by->full_name ?? 'N/A';
            })
            ->addColumn('status', function ($row) {
                return ucwords($row->status);
            })
            ->addColumn('action', function ($row) {
                return view('admin.feedback.actions', ['row' => $row]);
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
        $status = request()->query('status', null);
        if ($status != null) {
            $model = $model->where('status', 'like', "%$status%");
        }
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
            ->setTableId('table')
            ->columns($this->getColumns())
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
    protected function getColumns()
    {
        return [
            'business' => ['title' => 'Business Name'],
            'customer',
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
