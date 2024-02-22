<?php

namespace Modules\Acl\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Basic\Traits\validationRulesTrait;

class CreateRequest extends FormRequest
{
    use validationRulesTrait;
    /**
     * Determine if the User is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge(['mobile'=>$this->convertPersian($this->mobile)]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return User::getValidationRules();
    }

}
