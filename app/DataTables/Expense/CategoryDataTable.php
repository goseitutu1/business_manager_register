<?php

namespace App\DataTables\Expense;

use App\Models\ExpenseCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
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
                return view('expense.category.actions', ['row' => $row]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\ExpenseCategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ExpenseCategory $model)
    {
        $model = $model->where('business_id', session('business_id'))
            ->orWhere('business_id', null)
            ->orderBy('updated_at', 'desc');

        return $this->applyScopes($model);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('inventory-categories-table')
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
            'name',
            'created_at' => ['title' => 'Date Created'],
            'updated_at' => ['title' => 'Date Updated'],
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
        return 'ExpenseCategories_' . date('YmdHis');
    }
}
