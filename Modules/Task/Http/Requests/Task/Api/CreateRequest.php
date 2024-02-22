<?php

namespace Modules\Task\Http\Requests\Task\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Modules\Basic\Traits\ApiResponseTrait;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\CoreData\Service\CategoryService;
use Modules\Task\Entities\Task;

class CreateRequest extends FormRequest
{
    use ApiResponseTrait,validationRulesTrait;

    private $categoryService;
    /**
     * Determine if the Task is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * [__construct instantiate object]
     */
    public function __construct(CategoryService $categoryService)
    {
        parent::__construct();
        $this->categoryService = $categoryService;
    }

    protected function prepareForValidation()
    {
        if($this->time)
        {
            $this->merge(['time'=>$this->convertPersian($this->time)]);
        }
        if(isset($this->category) && in_array(0,$this->category))
        {
            $category=$this->category;
            $category[array_search(0, $this->category)] = $this->categoryService->findBy(new Request(['name'=>'اي شغل']),false,10,[],'first')->id ?? 0;
            $this->merge(['category'=>$category]);
        }
        if(count($this->category) <= 10)
        {
            $this->merge(['count_category' => true]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules()
    {
        $rules= Task::getValidationRules();
        $rules['count_category'] = "required";
        return $rules;
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiValidation($validator->errors()));
    }
    public function messages()
    {
        $messages = [
            'count_category.required' => "لا يمكن اختيار اكثر من 10",
        ];
        return $messages;
    }
}
