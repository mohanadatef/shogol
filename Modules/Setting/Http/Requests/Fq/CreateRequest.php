<?php

namespace Modules\Setting\Http\Requests\Fq;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\Setting\Entities\Fq;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->translationValidationRules(Fq::Class,Fq::getValidationRules(),Fq::translationKey());
    }


}
