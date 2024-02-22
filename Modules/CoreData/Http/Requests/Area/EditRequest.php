<?php

namespace Modules\CoreData\Http\Requests\Area;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\CoreData\Entities\Area;

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
        $rules= Area::getValidationRules();
        $rules = $this->translationValidationRules(Area::Class,$rules,Area::translationKey(),$this->id);
        $rules['order'] = $rules['order'].',order,'.$this->id.',id';
        return $rules;
    }

}
