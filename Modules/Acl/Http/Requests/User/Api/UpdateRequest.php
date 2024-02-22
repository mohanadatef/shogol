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

class UpdateRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        try{
        if(isset($this->skill) && !empty($this->skill))
        {
            $count = array_count_values(array_column($this->skill, 'type'));
            if(isset($count[skillType()['ls']]) && $count[skillType()['ls']] >= getValueSetting('skill_count_required') || getValueSetting('skill_count_required') == 0)
            {
                $this->merge(['count' => true]);
            }
        }else
        {
            $this->merge(['count' => true]);
        }
        }catch(\Exception $e)
        {
            return null;
        }
        if(isset($this->mobile))
        {
            $this->merge(['mobile' => $this->convertPersian($this->mobile)]);
        }
        if(isset($this->role_convert) && $this->role_convert)
        {
            $user = User::find($this->id);
            if($user->role_id == 2)
            {
                $this->merge(['role_id' => 3]);
            }
        }
        if(isset($this->job_name))
        {
            $job = app()->make(JobNameService::class)->findBy(new Request(['name' => $this->job_name]), false, 10, 'count');
            if($job == 0)
            {
                foreach(language() as $lang)
                {
                    $name[$lang->code] = $this->job_name;
                }
                $id = app()->make(JobNameService::class)->store(new Request(['name' => $name]))->id;
                $this->merge(['job_name_id' => $id]);
            }else
            {
                $job = app()->make(JobNameService::class)->findBy(new Request(['name' => $this->job_name]), false, 10, 'first')->id;
                $this->merge(['job_name_id' => $job]);
            }
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = User::getValidationRulesUpdate();
        $rules['nationality_number'] = $rules['nationality_number'] . ',nationality_number,' . $this->id . ',id';
        $rules['commercial_number'] = $rules['commercial_number'] . ',commercial_number,' . $this->id . ',id';
        $rules['tax_number'] = $rules['tax_number'] . ',tax_number,' . $this->id . ',id';
        $rules['email'] = $rules['email'] . ',email,' . $this->id . ',id';
        $rules['count'] = "required";
        if(isset($this->role_convert) && $this->role_convert)
        {
            $user = User::find($this->id);
            if($user->role_id == 2)
            {
                $rules['category'] = $rules['category'] . '|required';
                $rules['info'] = $rules['info'] . '|required';
                $rules['description'] = $rules['description'] . '|required';
            }
        }
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiValidation($validator->errors()));
    }

    public function messages()
    {
        $messages = ['count.required' => str_replace(':count', getValueSetting('skill_count_required'), getCustomTranslation('skill_validation')),];
        return $messages;
    }
}
