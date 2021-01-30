<?php

namespace App\Http\Requests\Program;

use App\Http\Requests\BaseRequest;

class UpdateProgramRequest extends BaseRequest
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
            'university_id'=>'required|exists:universities,id',
        ];
    }
}
