<?php

namespace App\Http\Controllers\Sales\Payments;

use App\DataTables\Sales\Payment\PaidDataTable;
use App\Http\Controllers\Controller;

class PaidController extends Controller
{
    public function index(PaidDataTable $dataTable)
    {
        return $dataTable->render('sales.product.index', [
            "page" => (object) [
                'title' => "Paid Goods| Payment Fully Received", 'section' => 'Payment Transactions'
            ],
        ]);
    }
}
