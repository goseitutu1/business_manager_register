<?php

namespace App\Api\Controllers\v1;

use App\Api\Controllers\BaseController;
use App\Models\AccountType;

/**
 * @group Account Types
 *
 * APIs for managing account types
 */
class AccountTypeController extends BaseController {

    /**
     * All Account Types
     *
     * Returns the json representation of all account Types
     *
     * @authenticated
     *
     * @response {
     *  "data": [
     *     {"name": "Expenses", "code": 1, "id": "9b6RVVPyNb"},
     *     {"name": "Revenues", "code": 2, "id": "DbDMZwBAdl"}
     *   ]
     * }
     */
    public function all() {
        $data = AccountType::select('name', 'code', 'id_hash AS id')->toBase()->get();

        return ['data' => $data];
    }
}
