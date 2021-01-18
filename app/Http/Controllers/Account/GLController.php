<?php

namespace App\Http\Controllers\Account;

use App\DataTables\Account\GLDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSales;
use App\Models\GLAccount;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sales;
use App\Models\Service;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GLController extends Controller
{
    public function index(GLDataTable $dataTable)
    {
        return $dataTable->render('account.gl.index', [
            "page" => (object) [
                'title' => "Accounts | GL Accounts", 'section' => 'General Ledgers'
            ],
        ]);
    }
}
