<?php

namespace App\Http\Requests\University;

use App\Http\Requests\BaseRequest;

class UpdateUniversityRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:30',
        ];
    }
}
