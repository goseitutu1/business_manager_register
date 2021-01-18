<?php

namespace App\Api\Controllers\v1;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\TaxTransformer;
use App\Models\Tax;

/**
 * @group Tax
 *
 * APIs for managing currencies
 */
class TaxController extends BaseController {

    /**
     * All Taxes
     *
     * Returns the json representation of all taxes
     *
     * @authenticated
     * @transformer App\Api\Transformers\v1\TaxTransformer
     */
    public function all() {
        $data = Tax::all();
        return $this->response->collection($data, new TaxTransformer());
    }
}
