<?php


namespace App\Api\Helpers;


use Hashids\Hashids;

class HashIdHelper {
    /*
     * Generate new hash id from 3 random numbers
     */
    public static function generateId() {
        $hashids = new Hashids(config('hashid_secret'), 5);
        return $hashids->encode(rand(0, 99999999999), rand(0, 99999999999));
    }
}
