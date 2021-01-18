<?php

namespace App\Api\Transformers\v1;

use App\Models\FAQ;
use League\Fractal\TransformerAbstract;

class FAQTransformer extends TransformerAbstract
{

    /**
     * Turn this item object into a generic array
     *
     * @param FAQ $faq
     * @return array
     */
    public function transform(FAQ $faq)
    {
        return [
            'id' => $faq->id_hash,
            'question' => $faq->question,
            'answer' => $faq->answer,
        ];
    }
}
