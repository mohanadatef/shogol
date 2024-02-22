<?php

namespace Modules\Setting\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\Setting\Entities\Page;

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
        return $this->translationValidationRules(Page::Class,Page::getValidationRules(),Page::translationKey());
    }


}
