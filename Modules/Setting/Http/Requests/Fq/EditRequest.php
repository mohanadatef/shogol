<?php

namespace Modules\Setting\Http\Requests\Fq;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\Setting\Entities\Fq;

class EditRequest extends FormRequest
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
        $rules = $this->translationValidationRules(Fq::Class,Fq::getValidationRules(),Fq::translationKey(),$this->id);
        $rules['order'] = $rules['order'].',order,'.$this->id.',id';
        return $rules;
    }

}
