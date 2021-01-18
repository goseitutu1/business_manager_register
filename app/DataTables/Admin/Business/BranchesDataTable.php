<?php

namespace App\DataTables\Admin\Business;

use App\Models\Business;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BranchesDataTable extends DataTable
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
            ->addColumn('employees',  function ($row) {
                $total = $row->employees()->count();
                if ($total == 0) {
                    return $total;
                };

                $url = route('admin.business.employees', ['businessId' => $row->id]);
                return "<a href='$url'>$total</a>";
            })
            ->addColumn('action', function ($row) {
                return view('admin.business.actions', ['row' => $row]);
            })
            ->rawColumns(['branches', 'employees', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\Business $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Business $model)
    {
        $owner = User::where('id_hash', request()->route('ownerId', null))->first();
        $model = $model->where('owner_id', @$owner->id)
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
            ->setTableId('employee-table')
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
            'name',
            'employees',
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
        return 'employees_' . date('YmdHis');
    }
}
