<?php

namespace App\Http\Requests\TrainingCategory;

use App\Http\Requests\BaseRequest;

class StoreTrainingCategoryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
        ];
    }
}
