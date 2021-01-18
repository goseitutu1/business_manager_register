<?php

namespace App\DataTables\Expense;

use App\Models\Expense;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class ExpenseDataTable extends DataTable
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
            ->addColumn('created_at', function ($row) {
                return $row->created_at->toFormattedDateString();
            })
            ->addColumn('amount_paid', function ($row) {
                return number_format($row->amount_paid, 2);
            })
            ->addColumn('total_amount', function ($row) {
                return number_format($row->total_amount, 2);
            })
            ->addColumn('amount_remaining', function ($row) {
                $val = number_format($row->amount_remaining, 2);
                if ($row->amount_remaining > 0) {
                    return "<span class='badge badge-danger'>($val)</span>";
                }
                if ($row->amount_remaining < 0)
                    return "<span class='badge badge-success'>$val</span>";

                return number_format($row->amount_remaining, 2);
            })
            ->addColumn('supplier', function ($row) {
                return $row->supplier->full_name ?? "N/A";
            })
            ->addColumn('action', function ($row) {
                $other_buttons = '<a style="margin-right: 2px; margin-bottom: 2px" href="'.route('expense.edit', $row->id).'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>'
                    . '<a onclick="confirm(\'Are you sure you want to delete this record\')" href="'.route('expense.delete', $row->id).'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
                if ($row->type == "paid")
                {
                   return  $buttons = '<span class="badge badge-sm badge-success" style="margin-right: 2px; margin-bottom: 2px">Closed</span>';
                   // return '<div class="btn-group">'.$buttons.$other_buttons.'</div>';
                }
                elseif (preg_match("/owing|partial/", $row->type))
                {
                    //$buttons = view('expense.actions', ['row' => $row]);

                    $buttons = '<a style="margin-right: 2px; margin-bottom: 2px" title="Expense Payments" href="'. route('expense.payments.index', ['expense_id' => $row->id]). '"   data-toggle="tooltip" data-placement="top" title="Payments"
                            class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i> Payments
                        </a>';
                    return '<div class="btn-group">'.$buttons.$other_buttons.'</div>';
                }else{
                    return '<div class="btn-group">'.$other_buttons.'</div>';
                }
            })
            ->rawColumns(['amount_remaining', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Models\Expense $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Expense $model)
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
                    ->setTableId('expenses-table')
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
            'created_at' => ['title' => 'Date'],
            'expense_no',
            'supplier',
            'total_amount' => ['title' => 'Total Amount (GH¢)'],
            'amount_paid' => ['title' => 'Amount Paid (GH¢)'],
            'amount_remaining' => ['title' => 'Amount Remaining (GH¢)'],
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
        return 'expenses_' . date('YmdHis');
    }
}
