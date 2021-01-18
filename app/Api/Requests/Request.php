<?php

namespace App\Api\Requests;

//use App\Exceptions\ApiValidationException;
//use App\Http\Requests\ValidationMessages;
use Dingo\Api\Exception\ResourceException;
use Dingo\Api\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use phpDocumentor\Reflection\Types\Parent_;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Request extends FormRequest {
//    use ValidationMessages;
    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'default';

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     *
     * @return mixed
     */
//    protected function failedValidation(Validator $validator) {
//        if ($this->container['request'] instanceof Request) {
//            throw new ValidationHttpException($validator->errors());
//        }
//
//        parent::failedValidation($validator);
//    }

    /**
     * {@inheritdoc}
     */
    protected function failedValidation(Validator $validator) {
        if ($this->is(config('api.prefix') . '/*')) {
            throw new ResourceException($validator->errors()->first(), $validator->getMessageBag());
        }
        parent::failedValidation();
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @return mixed
     */
    protected function failedAuthorization() {
        if ($this->container['request'] instanceof Request) {
            throw new HttpException(403);
        }

        parent::failedAuthorization();
    }
}
