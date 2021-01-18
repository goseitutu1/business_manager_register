<?php

namespace App\Observers;

use App\Models\SalesItem;
use Illuminate\Support\Facades\Log;

class SalesItemObserver
{
    /**
     * Handle the sales item "created" event.
     *
     * @param  \App\Models\SalesItem  $salesItem
     * @return void
     */
    public function created(SalesItem $salesItem)
    {
        // Reduce the inventory product quantity
        if (isset($salesItem->product_id)) {
            $salesItem->product()->decrement('quantity', $salesItem->quantity);
            Log::info(
                "Reduced product: {$salesItem->product->name} quantity by: {$salesItem->quantity} for sales item: {$salesItem->id}"
            );
        }
    }

    /**
     * Handle the sales item "updating" event.
     *
     * @param  \App\Models\SalesItem  $salesItem
     * @return void
     */
    public function updating(SalesItem $new)
    {
        $old  = SalesItem::find($new->id);

        // Update the inventory product quantity
        if (isset($new->product_id)) {
            $diff = abs($old->quantity - $new->quantity);
            if ($old->quantity > $new->quantity) {
                $new->product()->increment('quantity', $diff);
                Log::info(
                    "Increased product: {$new->product->name} quantity by: $diff for updated sales item: {$new->id}"
                );
            }
            if ($old->quantity < $new->quantity) {
                $new->product()->decrement('quantity', $diff);
                Log::info(
                    "Reduced product: {$new->product->name} quantity by: $diff for updated sales item: {$new->id}"
                );
            }
        }
    }

    /**
     * Handle the sales item "updated" event.
     *
     * @param  \App\Models\SalesItem  $salesItem
     * @return void
     */
    public function updated(SalesItem $salesItem)
    {
        //
    }

    /**
     * Handle the sales item "deleted" event.
     *
     * @param  \App\Models\SalesItem  $salesItem
     * @return void
     */
    public function deleted(SalesItem $salesItem)
    {
        if (isset($salesItem->product_id)) {
            // Restore the inventory product quantity when item is deleted
            $salesItem->product()->increment('quantity', $salesItem->quantity);
            Log::info(
                "Increased product: {$salesItem->product->name} quantity by: {$salesItem->quantity} for deleted sales item: {$salesItem->id}"
            );

            // delete journal entries
            $salesItem->sales->payment->journal->entries()
                ->where('credit_comment','like', "%{$salesItem->product->name}%")->delete();
        }
    }

    /**
     * Handle the sales item "restored" event.
     *
     * @param  \App\Models\SalesItem  $salesItem
     * @return void
     */
    public function restored(SalesItem $salesItem)
    {
        // Reduce the inventory product quantity when item is restored
        if (isset($salesItem->product_id)) {
            $salesItem->product()->decrement('quantity', $salesItem->quantity);
            Log::info(
                "Reduced product: {$salesItem->product->name} quantity by: {$salesItem->quantity} for restored sales item: {$salesItem->id}"
            );
        }
    }

    /**
     * Handle the sales item "force deleted" event.
     *
     * @param  \App\Models\SalesItem  $salesItem
     * @return void
     */
    public function forceDeleted(SalesItem $salesItem)
    {
        // Restore the inventory product quantity when item is deleted
        if (isset($salesItem->product_id)) {
            $salesItem->product()->increment('quantity', $salesItem->quantity);
            Log::info(
                "Increased product: {$salesItem->product->name} quantity by: {$salesItem->quantity} for force deleted sales item: {$salesItem->id}"
            );
        }
    }
}
