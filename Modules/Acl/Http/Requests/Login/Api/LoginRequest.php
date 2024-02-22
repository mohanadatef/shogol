<?php

namespace Modules\Acl\Http\Requests\Login\Api;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Modules\Basic\Traits\ApiResponseTrait;

class LoginRequest extends FormRequest
{
    use ApiResponseTrait;
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
        return User::getValidationRulesLogin();
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiValidation($validator->errors()));
    }

}
