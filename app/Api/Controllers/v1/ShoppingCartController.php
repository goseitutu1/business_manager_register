<?php

namespace App\Api\Controllers\v1;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\ShoppingCart\ShoppingCartTransformer;
use App\Models\Product;
use App\Models\Service;
use App\Models\ShoppingCart;
use App\Models\Tax;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * @group Shopping Cart
 *
 * APIs for managing shopping cart
 */
class ShoppingCartController extends BaseController
{
    /**
     * Add Items
     *
     * Items should be grouped into arrays. If cart_id is set in the query params, the cart will be updated with the new items
     *
     * @authenticated
     * @queryParam cart_id If it set, the existing cart will be updated else new one will be created
     * @bodyParam total float required The total amount of the sales including tax.
     * @bodyParam quantity float optional The total quantity sold. Required if item is a product.
     * @bodyParam total_tax float The total tax amount of the sales.
     * @bodyParam product_id string optional The id of the product .
     * @bodyParam service_id string optional The id of the service .
     *
     * @transformer App\Api\Transformers\v1\ShoppingCart\ShoppingCartTransformer
     *
     * @response 422 {
     *  "status_code": 422,
     *  "message": "Item 1: The selected product id is invalid.",
     *  "errors": {
     *     "business_id": ["The selected product id is invalid."]
     *   }
     * }
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function add_items(Request $request)
    {
        $inputs = $request->input();
        $main = ['total_tax' => 0, 'total' => 0, 'user_id' => auth('api')->user()->id];
        $old_cart = null;

        // if the cart_id is set in the query parameter,
        // retrieve the old cart totals
        if (!empty($inputs['cart_id'])) {
            $old_cart = ShoppingCart::where('id_hash', $inputs['cart_id'])
                ->where('user_id', auth('api')->user()->id)->first();
            $main = ['total_tax' => $old_cart->tax_total, 'total' => $old_cart->total];
        }

        // remove the cart_id from requests data
        // since it won't be needed anymore
        unset($inputs['cart_id']);

        $verifited_items = [];
        foreach ($inputs as $index => &$item) {
            $max = '';
            if (isset($item['product_id'])) {
                $product = Product::findByIdHash($item['product_id']);

                if (!isset($product)) {
                    throw new StoreResourceFailedException("Item " . ($index + 1) . ': ' . "Product Not Found");
                }
                $max = $product->quantity - ($product->threshold ?? 0);
                $max = "max:$max";
            }
            $validator = Validator::make($item, [
                'quantity' => "numeric|min:0|$max",
                'total' => 'nullable|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                'tax_amount' => 'nullable|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                'product_id' => 'exists:products,id_hash',
                'service_id' => 'exists:services,id_hash',
                'tax_id' => 'nullable|exists:taxes,id_hash',
            ]);
            if ($validator->fails()) {
                throw new StoreResourceFailedException(
                    "Item " . ($index + 1) . ': ' . $validator->errors()->first(),
                    $validator->errors()
                );
            }
            if (isset($item['service_id']))
                $res = $this->calculateItemTotals($item, 'service');
            else
                $res = $this->calculateItemTotals($item);

            $verifited_items[] = $res;
            $main['total_tax'] += $res['tax_amount'] ?? 0;
            $main['total'] += $res['total'];
        }

        DB::transaction(function () use ($verifited_items, &$main, &$old_cart) {
            if ($old_cart != null) {
                $old_cart->update($main);
                foreach ($verifited_items as $index => $item) {
                    $old_cart->items()->updateOrCreate($item);
                }
                auth()->user()->log("Added items to shopping cart. id: {$old_cart->id}");
            } else {
                $main = ShoppingCart::create($main);
                foreach ($verifited_items as $index => $item) {
                    $main->items()->create($item);
                }
                auth()->user()->log("created shopping cart. id: {$main->id}");
            }
        });
        $cart = $old_cart ?? ShoppingCart::latest()->with(['items'])->first();
        return $this->response->item($cart, new ShoppingCartTransformer());
    }

    /**
     * Re-calculate the totals of the cart items
     *
     * @param array $item
     * @param string $type
     * @return void
     */
    private function calculateItemTotals(array $item, $type = "product")
    {
        if ($type == "service") {
            $service = Service::findByIdHash($item['service_id']);
            $item['total'] = $service->amount ?? 0;
            $item['service_id'] = $service->id;
            $item['unit_price'] = $service->amount;
        } else {
            $product = Product::findByIdHash($item['product_id']);
            $item['total'] =  $product->selling_price * ($item['quantity'] ?? 0);
            $item['product_id'] = $product->id;
            $item['unit_price'] = $product->selling_price;
        }

        // calculate taxes if it exists
        if (!empty($item['tax_id'])) {
            $tax = @Tax::where('name', 'like', $item['tax_type'])
                ->orWhere('id_hash', $item['tax_type'])
                ->first();
            $total_tax = $tax->percentage *  $tax;

            $item['tax_id'] = $tax->id;
            $item['tax_amount'] = $total_tax;
        }
        return $item;
    }

    /**
     * View Cart
     *
     * Returns the json representation of all the items in a shopping cart
     *
     * @authenticated
     * @urlParam id required The id of the shopping cart. Example: Wpmbk5ezJn
     *
     * @transformer App\Api\Transformers\v1\ShoppingCart\ShoppingCartTransformer
     *
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Shopping Cart not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function view()
    {
        $cart = ShoppingCart::where('id_hash', request('id'))->with(['items'])->first();
        if (!isset($cart))
            $this->response->errorNotFound("Shopping Cart not found");

        auth()->user()->log("Viewed shopping cart: {$cart->id}");
        return $this->response->item($cart, new ShoppingCartTransformer());
    }

    /**
     * Delete Cart Item
     *
     * If 'items' query parameter is not set, the main cart will be deleted.
     *
     * @authenticated
     * @urlParam id required The id of the product. Example: Wpmbk5ezJn
     * @queryParam items Comma separated list of the shopping cart items id. Eg. ...?items=RgWQ9kwVFRvyvMNo,911N5woRcxXNvNoG
     *
     * @response  {
     *  "status_code": 200,
     *  "message": "Cart deleted successfully"
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Cart not found"
     * }
     */
    public function delete($id)
    {
        $cart = ShoppingCart::findByIdHash($id);
        if (!isset($cart))
            $this->response->errorNotFound("Cart not found");

        $is_cart_deleted = false;
        DB::transaction(function ()  use (&$cart, &$is_cart_deleted) {
            $items = explode(",", request()->query('items', null));

            // because php explode return an array with the first item
            // empty even if the string subject is empty.
            // So we check wether the first item of the array is empty.
            // If it is, we the proceed to delete the whole cart
            if (empty($items[0])) {
                $cart->delete();
                $is_cart_deleted = true;
                auth()->user()->log("Deleted cart: {$cart->id}");
                return;
            }

            foreach ($items as $item_id) {
                $item = $cart->items()->where('id_hash', $item_id)->first();
                if (!isset($item))
                    $this->response->errorNotFound("Cart Item not found for id: $item_id");

                $cart->decrement('total', $item->total);
                $cart->decrement('total_tax', $item->tax_amount ?? 0);
                $cart->save();
                $item->delete();

                auth()->user()->log("Deleted cart item: $item_id from cart: {$cart->id}");
            }
        });

        if ($is_cart_deleted)
            return ['status_code' => 200, 'message' => "Cart deleted successfully"];

        return $this->response->item(ShoppingCart::findByIdHash($id), new ShoppingCartTransformer());
    }
}
