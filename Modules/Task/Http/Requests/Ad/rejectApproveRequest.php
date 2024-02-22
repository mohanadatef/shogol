<?php

namespace Modules\Task\Http\Requests\Ad;

use Illuminate\Foundation\Http\FormRequest;

class rejectApproveRequest extends FormRequest
{
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
        return [
            'comment'=>'min:0|max:100|string|nullable',
            'cancellation_id'=>'required|exists:cancellations,id',
        ];
    }



}
