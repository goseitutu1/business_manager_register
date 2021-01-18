<?php

namespace App\Api\Controllers\v1;

use App\Api\Controllers\BaseController;
use App\Api\Requests\v1\PaymentRequest;
use App\Api\Transformers\v1\Payment\ClientStatementTransformer;
use App\Api\Transformers\v1\PaymentTransformer;
use App\Models\Business;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Sales;
use App\Models\ShoppingCart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @group Payments
 *
 * APIs for managing sales payments
 */
class PaymentController extends BaseController
{


    public function create(PaymentRequest $request)
    {
        //TODO!: update payment calculation to check for partial and paid payments
        $inputs = $request->all();
        $bus = Business::findByIdHash($inputs['business_id']);

        $inputs['business_id']  = $bus->id;
        if (isset($inputs['customer_id'])) {
            $inputs['customer_id'] = Customer::findByIdHash($inputs['customer_id'])->id;
        }
        if (!empty($inputs['due_date'])) {
            $inputs['due_date'] = Carbon::parse($inputs['due_date'], 'UTC')->toDateString();
        }
        DB::transaction(function () use (&$inputs, $bus) {
            $inputs = $this->calculate_payment($inputs);
            $cart = ShoppingCart::find($inputs['shopping_cart_id']);

            $sales = Sales::createFromShoppingCart($cart, $bus);
            $inputs['sales_id'] = $sales->id;
            $payment = Payment::create($inputs);

            // if (isset($payment->phone_number) && !empty($payment->amount_paid))
            //     MoMoPaymentController::initiatePayment($payment);

            auth()->user()->log("Added new payment. id: '{$payment->id}'");
        });

        return $this->response->item(Payment::latest()->first(), new PaymentTransformer());
    }


    /**
     * Update Payment
     *
     * Update the information of a payment
     *
     * @authenticated
     * @bodyParam unit_price float required The unite price of the product.
     * @bodyParam total float required The total amount of the sales including tax.
     * @bodyParam total_tax float The total tax amount of the sales.
     * @bodyParam payment_date date The date at which the sales was/is made.
     * @bodyParam is_taxed bool Whether the sales was taxed
     * @bodyParam tax_type string The type of tax, if taxable. eg: vat flat, vat standard, nhil, getfund
     * @bodyParam product_sales_id string The id of the product sales.
     * @bodyParam service_sales_id string The id of the services sales.
     * @bodyParam business_id string required The id of the business.
     *
     * @transformer App\Api\Transformers\v1\PaymentTransformer
     * @response 422 {
     *  "status_code": 422,
     *  "message": "Could not update sales.",
     *  "errors": {
     *     "business_id": ["The selected business id is invalid."]
     *   }
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "PaymentTransformer not found"
     * }
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(PaymentRequest $request)
    {
        $main = Payment::where('id_hash', request('id', ''))->first();
        if (!isset($main)) {
            $this->response->errorNotFound("Payment not found");
        }
        $inputs = request()->all();
        $inputs['business_id'] = Business::findByIdHash($inputs['business_id'])->id;
        if (isset($inputs['customer_id'])) {
            $inputs['customer_id'] = Customer::findByIdHash($inputs['customer_id'])->id;
        }
        $inputs = $this->calculate_payment($inputs);
        //        $validator = Validator::make($request->all(), [
        //            'discount_value' => 'regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
        //            'total_paid' => 'required|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
        //            'total_payable' => 'required|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
        //            'discount_applied' => 'boolean',
        //            'payment_method' => 'string',
        //            'discount_type' => 'string',
        //            'business_id' => 'required|exists:businesses,id_hash',
        //            'product_sales_id' => 'exists:product_sales,id_hash',
        //            'service_sales_id' => 'exists:service_sales,id_hash',
        //        ]);
        //        if ($validator->fails())
        //            throw new StoreResourceFailedException('Could not update payment.', $validator->errors());
        //
        //        $data = request()->all();
        //        $data['business_id'] = Business::where('id_hash', $data['business_id'])->first()->id;
        //        if (isset($data['product_sales_id']))
        //            $data['product_sales_id'] = ProductSales::where('id_hash', $data['product_sales_id'])->first()->id;
        //        if (isset($data['service_sales_id']))
        //            $data['service_sales_id'] = ServiceSales::findByIdHash($data['service_sales_id'])->id;
        //
        //        $data = $this->calculate_payment($data);
        //
        //        // Remove id_hash, business_id, id fields it exist
        //        unset($data['id_hash'], $data['id'], $data['business_id']);

        $main->update($inputs);
        auth()->user()->log("updated payment: {$main->id}");
        return $this->response->item($main, new PaymentTransformer());
    }

    /**
     * All Payments
     *
     * Returns the json representation of all payments belonging to a business
     *
     * @authenticated
     * @urlParam business_id required The id of the business. Example: Wpmbk5ezJn
     * @queryParam customer_id The id of the customer. If its set, only payments of this customer will be returned.
     *
     * @transformerCollection App\Api\Transformers\v1\PaymentTransformer
     * @transformerModel App\Models\Payment
     *
     * @response 404{
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function all()
    {
        $bus = Business::findByIdHash(request('business_id'));
        if (!isset($bus))
            $this->response->errorNotFound("Business not found");

        $customer_id = request()->query('customer_id', null);
        if (isset($customer_id)) {
            $customer = Customer::findByIdHash($customer_id);
            if (!isset($customer))
                $this->response->errorNotFound("Customer not found");

            $res = Payment::where('business_id', $bus->id)
                ->where('customer_id', $customer->id)->get();
        } else {
            $res = Payment::where('business_id', $bus->id)->get();
        }

        auth()->user()->log("viewed all payments for business: {$bus->name}");
        return $this->response->collection($res, new PaymentTransformer());
    }

    /**
     * View Payment
     *
     * Returns the json representation of a payment
     *
     * @authenticated
     * @urlParam id required The id of the business. Example: Wpmbk5ezJn
     *
     * @transformer App\Api\Transformers\v1\PaymentTransformer
     * @transformerModel App\Models\Payment
     *
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Payment ot found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function view()
    {
        $payment = Payment::where('id_hash', request('id'))->first();
        if (!isset($payment))
            $this->response->errorNotFound("Payment not found");

        auth()->user()->log("Viewed sales payment: {$payment->id}");
        return $this->response->item($payment, new PaymentTransformer());
    }

    /**
     * Delete Payment
     *
     * @authenticated
     * @urlParam id required The id of the payment. Example: Wpmbk5ezJn
     *
     * @response {
     *  "status_code": 200,
     *  "message": "Payment deleted successfully"
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Payment not found"
     * }
     */
    public function delete()
    {
        $res = Payment::where('id_hash', request('id', ''))->first();
        if (!isset($res))
            $this->response->errorNotFound("Payment not found");

        $res->delete();
        auth()->user()->log("Deleted payment: {$res->id}");
        return ['status_code' => 200, 'message' => "Payment deleted successfully"];
    }

    // helpers
    private function calculate_payment($inputs)
    {
        if (!empty($inputs['shopping_cart_id'])) {
            $cart = ShoppingCart::findByIdHash($inputs['shopping_cart_id']);
            $total = $cart->total;
            $inputs['shopping_cart_id'] = $cart->id;
        } else {
            $total = $inputs['total_amount'];
        }
        if (isset($inputs['discount_applied'])) {
            if ($inputs['discount_applied']) {
                if (strtolower($inputs['discount_type'] == "fixed"))
                    $total -= $inputs['discount_value'];
                if (preg_match('/percent[age]/i', $inputs['discount_type']))
                    $total -= ($inputs['discount_value'] * 0.01) * $inputs['total_payable'];
            }
        }
        $inputs['total_amount'] = $total;
        return $inputs;
    }


    /**
     * Client Statement
     *
     * Returns the json representation of all payments by customer.
     *
     * @authenticated
     * @queryParam type The type of the report. It can be weekly, daily or monthly. Defaults to daily if no value is set.
     *
     * @transformerCollection App\Api\Transformers\v1\Payment\ClientStatementTransformer
     *
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Customer not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function client_statement()
    {
        $customer = Customer::findByIdHash(request('id'));
        if (!isset($customer))
            $this->response->errorNotFound("Customer not found");

        $now = Carbon::now();
        $type = request()->query('type', 'daily');

        $resp = Payment::where('customer_id', $customer->id);
        if (strtolower($type) == 'weekly') {
            $resp->whereBetween('created_at', [$now->startOfWeek()->toDateString(), $now->endOfWeek()->toDateString()]);
        }
        if (strtolower($type) == 'monthly') {
            $dates = [Carbon::now()->startOfMonth()->toDateString(), Carbon::now()->endOfMonth()->toDateString()];
            $resp->whereBetween('created_at', $dates);
        }

        auth()->user()->log("Viewed payments for customer: {$customer->full_name}");
        return $this->response->collection($resp->get(), new ClientStatementTransformer());
    }
}
