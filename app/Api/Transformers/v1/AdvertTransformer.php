<?php

namespace App\Api\Transformers\v1;

use App\Models\Advert;
use League\Fractal\TransformerAbstract;

class AdvertTransformer extends TransformerAbstract
{

    /**
     * Turn this item object into a generic array
     *
     * @param Advert $advert
     * @return array
     */
    public function transform(Advert $advert)
    {
        return [
            'id' => $advert->id_hash,
            'title' => $advert->title,
            'feature_image' => $advert->feature_image,
            'status' => $advert->status,
            'author' => $advert->author,
        ];
    }
}
