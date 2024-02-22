<?php

namespace Modules\Acl\Http\Requests\User\Api;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Modules\Basic\Traits\ApiResponseTrait;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\CoreData\Service\JobNameService;

class UserNameRequest extends FormRequest
{
    use ApiResponseTrait, validationRulesTrait;

    /**
     * Determine if the User is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['username'=>User::$rules['username']];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiValidation($validator->errors()));
    }
}
