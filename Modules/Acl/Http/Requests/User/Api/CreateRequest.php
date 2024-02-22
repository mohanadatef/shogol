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

class CreateRequest extends FormRequest
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
        $this->merge(['mobile' => $this->convertPersian($this->mobile)]);
        if($this->tax_number)
        {
            $this->merge(['tax_number' => $this->convertPersian($this->tax_number)]);
        }
        if($this->commercial_number)
        {
            $this->merge(['commercial_number' => $this->convertPersian($this->commercial_number)]);
        }
        if($this->nationality_number)
        {
            $this->merge(['nationality_number' => $this->convertPersian($this->nationality_number)]);
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
        if(isset($this->category))
        {
            if(is_array($this->category))
            {
                $this->merge(['category' => $this->category]);
            }elseif(strpos($this->category, ',') !== false)
            {
                $this->merge(['category' => explode(',', $this->category)]);
            }else
            {
                $this->merge(['category' => [$this->category]]);
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
        $rules = User::getValidationRules();
        $rules['username'] = $rules['username'] . '|required';
        $rules['fullname'] = $rules['fullname'] . '|required';
        $rules['role_id'] = $rules['role_id'] . '|required';
        $rules['email'] = $rules['email'] . '|required';
        $rules['mobile'] = $rules['mobile'] . '|required';
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiValidation($validator->errors()));
    }
}
