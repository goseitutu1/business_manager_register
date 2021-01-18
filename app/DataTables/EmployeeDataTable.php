<?php

namespace App\DataTables;

use App\Models\Employee;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class EmployeeDataTable extends DataTable
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
                return $row->user->full_name;
            })
            ->addColumn('email', function ($row) {
                return $row->user->email;
            })
            ->addColumn('role', function ($row) {
                return $row->role->name;
            })
            ->addColumn('salary', function ($row) {
                return $row->salary;
            })
            ->addColumn('salary_due_date', function ($row) {
                $data = $row->salary_due_date;
                return isset($data) ? $data->toFormattedDateString() : "N/A";
            })
            ->addColumn('added_by', function ($row) {
                return $row->admin->full_name ?? "N/A";
            })
            ->addColumn('branch', function ($row) {
                return $row->business->name;
            })
            ->addColumn('action', function ($row) {
                return view('employee.actions', ['row' => $row]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\Employee $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Employee $model)
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
                    ->setTableId('employees-table')
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
            'role',
            'salary',
            'salary_due_date',
            'added_by',
            'branch',
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
        return 'employees_' . date('YmdHis');
    }
}
