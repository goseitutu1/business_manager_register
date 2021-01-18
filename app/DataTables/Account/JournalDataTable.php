<?php

namespace App\DataTables\Account;

use App\Models\Journal;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class JournalDataTable extends DataTable
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
        ->addColumn('transaction_date',  function ($row) {
            return $row->transaction_date->toFormattedDateString();
        })
        ->addColumn('credit_total',  function ($row) {
            return number_format($row->credit_total, 2);
        })
        ->addColumn('debit_total',  function ($row) {
            return number_format($row->debit_total, 2);
        })
        //TODO: implement actions
        ->addColumn('action', function ($row) {
            return view('account.journal.actions', ['row' => $row]);
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\Journal $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Journal $model)
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
            'batch_no',
            'transaction_date',
            'debit_total',
            'credit_total',
            'action'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function _filename()
    {
        return 'general-journal_' . date('YmdHis');
    }
}
