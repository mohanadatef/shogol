<?php

namespace Modules\Acl\Http\Requests\ForgetPassword;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Acl\Entities\ForgetPassword;

class changePasswordRequest extends FormRequest
{
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
        return ForgetPassword::getValidationRulesAdmin();
    }

}
