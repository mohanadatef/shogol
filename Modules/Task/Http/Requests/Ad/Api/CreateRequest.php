<?php

namespace Modules\Task\Http\Requests\Ad\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Modules\Basic\Traits\ApiResponseTrait;
use Modules\Basic\Traits\validationRulesTrait;
use Modules\Task\Entities\Ad;
use Modules\Task\Service\AdService;

class CreateRequest extends FormRequest
{
    use ApiResponseTrait,validationRulesTrait;

    private $adService;

    /**
     * Determine if the Ad is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * [__construct instantiate object]
     */
    public function __construct(AdService $adService)
    {
        parent::__construct();
        $this->adService = $adService;
    }

    protected function prepareForValidation()
    {
        if($this->price)
        {
            $this->merge(['price'=>$this->convertPersian($this->price)]);
        }
        $imageCount = $videoCount = 0;
        if (isset($this->id)) {
            $data = $this->adService->show($this->id);
            if(isset($data->documents))
            {
                foreach ($data->documents as $document) {
                    $ext = pathinfo($document->file, PATHINFO_EXTENSION);
                    if ($ext == 'mp4') {
                        $videoCount++;
                    } else {
                        $imageCount++;
                    }
                }
            }
        }
        if (isset($this->images) && !empty($this->images)) {
            $imageCount = $imageCount + count($this->images);
            if ($imageCount <= getValueSetting('images_ad_count') || getValueSetting('images_ad_count') == 0) {
                $this->merge(['count_images' => true]);
            }
        } else {
            $this->merge(['count_images' => true]);
        }
        if (isset($this->videos) && !empty($this->videos)) {
            $videoCount = $videoCount + count($this->videos);
            if ($videoCount <= getValueSetting('videos_ad_count') || getValueSetting('videos_ad_count') == 0) {
                $this->merge(['count_videos' => true]);
            }
        } else {
            $this->merge(['count_videos' => true]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Ad::getValidationRules();
        $rules['count_videos'] = "required";
        $rules['count_images'] = "required";
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiValidation($validator->errors()));
    }

    public function messages()
    {
        $messages = [
            'count_videos.required' => str_replace(':count', getValueSetting('videos_ad_count'), getCustomTranslation('videos_validation')),
            'count_images.required' => str_replace(':count', getValueSetting('images_ad_count'), getCustomTranslation('images_validation')),
        ];
        return $messages;
    }

}
