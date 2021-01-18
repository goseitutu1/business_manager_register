<?php

namespace App\Api\Controllers\v1;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\FAQTransformer;
use App\Models\FAQ;

/**
 * @group Adverts
 *
 * APIs for managing adverts
 */
class FAQController extends BaseController
{
    /**
     * All Feedback
     *
     * Returns the json representation of all adverts.
     *
     * @authenticated
     * @transformer App\Api\Transformers\v1\FAQTransformer
     *
     * @return \Dingo\Api\Http\Response
     */
    public function all()
    {
        auth('api')->user()->log("viewed all faq");
        return $this->response->collection(FAQ::all(), new FAQTransformer());
    }
}
