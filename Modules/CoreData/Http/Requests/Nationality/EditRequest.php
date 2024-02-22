<?php

namespace Modules\CoreData\Http\Requests\Nationality;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\CoreData\Entities\Nationality;

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
        $rules= Nationality::getValidationRules();
        $rules = $this->translationValidationRules(Nationality::Class,$rules,Nationality::translationKey(),$this->id);
        $rules['order'] = $rules['order'].',order,'.$this->id.',id';
        $rules['code'] = $rules['code'].',code,'.$this->id.',id';
        return $rules;
    }

}
