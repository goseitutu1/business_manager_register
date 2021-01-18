<?php

namespace App\Api\Transformers\v1;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->id_hash,
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'country' => $user->country,
            'phone_number' => $user->phone_number,
            'email' => $user->email,
            'type' => $user->type,
            'mobile_money_number' => $user->mobile_money_number
        ];
    }
}
