<?php

namespace App\Observers;

use App\Api\Helpers\HashIdHelper;
use App\Models\Sales;
use Illuminate\Support\Facades\Mail;

class SalesObserver
{
    /**
     * Handle the sales "creating" event.
     *
     * @param Sales $sales
     * @return void
     */
    public function creating(Sales $sales)
    {
        $sales->sales_no = "SALES" . sprintf('%06d', Sales::count() + 1);
        $sales->id_hash = HashIdHelper::generateId();
    }

    /**
     * Handle the sales "created" event.
     *
     * @param Sales $sales
     * @return void
     */
    public function created(Sales $sales)
    {

    }

    /**
     * Handle the sales "updated" event.
     *
     * @param Sales $sales
     * @return void
     */
    public function updated(Sales $sales)
    {
        //
    }

    /**
     * Handle the sales "deleted" event.
     *
     * @param Sales $sales
     * @return void
     */
    public function deleted(Sales $sales)
    {
        $sales->items()->delete();
        @$sales->payment()->delete();
    }

    /**
     * Handle the sales "restored" event.
     *
     * @param Sales $sales
     * @return void
     */
    public function restored(Sales $sales)
    {
        $sales->items()->restore();
        @$sales->payment()->restore();
    }

    /**
     * Handle the sales "force deleted" event.
     *
     * @param Sales $sales
     * @return void
     */
    public function forceDeleted(Sales $sales)
    {
        $sales->items()->forceDelete();
        @$sales->payment()->forceDelete();
    }
}
