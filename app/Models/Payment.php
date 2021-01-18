<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    //TODO: update customer api reports to use amount payable instead of total amount when checking of owing customers
    //TODO: add tax total
    protected $fillable = [
        'id_hash', 'payment_method', 'discount_applied', 'discount_type',
        'discount_value', 'total_discount', 'type', 'total_amount',
        'amount_remaining', 'amount_paid', 'amount_owed', 'amount_payable',
        'due_date', 'phone_number',  'payment_no', 'overpayment_amount',
        'cheque_number',
        'sales_id', 'customer_id', 'journal_id', 'business_id',
    ];

    protected $table = 'payments';

    protected $dates = ['created_at', 'deleted_at', 'updated_at', 'due_date'];

    protected $hidden = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function business()
    {
        return $this->belongsTo('App\Models\Business', 'business_id');
    }

    public function sales()
    {
        return $this->belongsTo('App\Models\Sales', 'sales_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function journal()
    {
        return $this->belongsTo('App\Models\Journal', 'journal_id');
    }

    // calculate payment amount
    public static function calculate_payment($inputs, $sales_type = "product")
    {
        $discount = 0;
        $results = (object) [
            'discount' => 0, 'disc_per_item' => 0,
            'total' => 0, 'tax_total' => 0, 'total_payable' => 0
        ];

        // re-calculate sales items details
        $checked_items = [];
        if (isset($inputs['items'])) {
            foreach ($inputs['items'] as $item) {
                // if item is a product
                if ($sales_type == "product") {
                    $price = Product::find($item['product_id'])->selling_price;
                    // $item['discount_amount'] = $results->disc_per_item;
                    $item['total'] = ($price * $item['quantity']);
                    $results->total += $item['total'];
                    // $item['total'] -= $results->disc_per_item;
                }

                // if item is a service
                if ($sales_type == "service") {
                    $price = Service::find($item['service_id'])->amount;
                    // $item['discount_amount'] = $results->disc_per_item;
                    $item['amount'] = $price * ($item['quantity'] ?? 1);
                    $item['total'] = $item['amount'];
                    $results->total += $item['amount'];
                    // $item['total'] -= $results->disc_per_item;
                }

                $item['business_id'] = session('business_id');
                $checked_items[] = $item;
            }
        }

        // calculate discount and apply to each item
        if (!empty($inputs['discount_value'])) {
            if (preg_match('/fixed/i', $inputs['discount_type']))
                $discount = $inputs['discount_value'];
            if (preg_match('/percent[age]/i', $inputs['discount_type']))
                $discount = ($inputs['discount_value'] * 0.01) * $results->total;
            $results->discount = $discount;
            $results->disc_per_item = $discount / count($checked_items);
        }

        $final_items = [];
        foreach ($checked_items as $item) {
            // if item is a product
            if ($sales_type == "product") {
                $item['discount_amount'] = $results->disc_per_item;
                $item['total'] = ($price * $item['quantity']);
                $item['total'] -= $results->disc_per_item;
            }

            // if item is a service
            if ($sales_type == "service") {
                $item['discount_amount'] = $results->disc_per_item;
                $item['total'] -= $results->disc_per_item;
            }
            $final_items[] = $item;
        }


        $results->total_payable = $results->total - $results->discount;
        $inputs['amount_paid'] = $inputs['amount_paid'] ?? 0;
        $owed = $results->total_payable - $inputs['amount_paid'];
        if ($owed < 0) {
            $inputs['overpayment_amount'] = $owed;
            $inputs['amount_owed'] = 0;
        } else {
            $inputs['amount_owed'] = $owed;
        }
        $inputs['amount_remaining'] = $inputs['amount_owed'];

        if (preg_match('/credit|owing|partial/i', $inputs['type'])) {
            $inputs['amount_paid'] = 0;
            $inputs['type'] = "owing";
        }
        if (preg_match('/cash|paid/i', $inputs['type'])) {
            $inputs['type'] = "paid";
        }

        $inputs['total_amount'] = $results->total; // for payments model
        $inputs['total'] = $results->total; // for sales model
        $inputs['amount_payable'] = $results->total_payable;
        $inputs['total_discount'] = $results->discount;
        $inputs['items'] = $final_items;
        return $inputs;
    }
}
