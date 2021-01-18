<?php

namespace App\Api\Transformers\v1;

use App\Models\Employee;
use League\Fractal\TransformerAbstract;

class EmployeeTransformer extends TransformerAbstract {

    /**
     * Turn this item object into a generic array
     *
     * @param Employee $emp
     * @return array
     */
    public function transform(Employee $emp) {
        $user_trans = new UserTransformer();
        $user = $user_trans->transform($emp->user);
        $user['user_id'] = $user['id'];
        return array_merge($user, [
            'id' => $emp->id_hash,
            'role' => $emp->role->name,
            'business' => $emp->business->name
        ]);
    }

}
