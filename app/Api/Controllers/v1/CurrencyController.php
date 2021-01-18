<?php

namespace App\Api\Controllers\v1;

use App\Api\Controllers\BaseController;
use App\Models\Currency;

/**
 * @group Currency
 *
 * APIs for managing currencies
 */
class CurrencyController extends BaseController {

    /**
     * All currencies
     *
     * Returns the json representation of all currencies
     *
     * @authenticated
     * @transformer App\Api\Transformers\v1\CurrencyTransformer
     */
    public function all() {
        $data = Currency::select('name', 'code', 'sign', 'id_hash AS id')->toBase()->get();

        return response()->json(['data' => $data]);
    }
}
