<?php

namespace App\Http\Requests\Program;

use App\Http\Requests\BaseRequest;

class StoreProgramRequest extends BaseRequest
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
            'university_id'=>'required|exists:universities,id',
        ];
    }
}
