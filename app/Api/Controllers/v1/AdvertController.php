<?php

namespace App\Api\Controllers\v1;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\AdvertTransformer;
use App\Models\Advert;

/**
 * @group Adverts
 *
 * APIs for managing adverts
 */
class AdvertController extends BaseController
{
    /**
     * All Adverts
     *
     * Returns the json representation of all adverts.
     *
     * @authenticated
     * @transformer App\Api\Transformers\v1\AdvertTransformer
     *
     * @return \Dingo\Api\Http\Response
     */
    public function all()
    {
        auth('api')->user()->log("viewed all adverts");
        return $this->response->collection(Advert::all(), new AdvertTransformer());
    }

    /**
     * View Advert
     *
     * Returns the json representation of an advert
     *
     * @authenticated
     * @urlParam id required The id of the advert. Example: Wpmbk5ezJn
     *
     * @transformer App\Api\Transformers\v1\AdvertTransformer
     *
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Advert not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function view($id)
    {
        $ads = Advert::findByIdHash($id);

        if (!isset($ads)) {
            $this->response->errorNotFound("Advert not found");
        }

        auth('api')->user()->log("Viewed advert: {$ads->id}");
        return $this->response->item($ads, new AdvertTransformer());
    }
}
