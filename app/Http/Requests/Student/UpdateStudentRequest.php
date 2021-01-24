<?php

namespace App\Http\Requests\Student;

use App\Http\Requests\BaseRequest;

class UpdateStudentRequest extends BaseRequest
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
            'image' => 'mimes:jpeg,jpg,png|max:20000|dimensions:min_width=500,min_height=500',
            'email1' => 'required',
            'gender' => 'required',
            'job' => 'sometimes',
            'mobile1' => 'required',
            'national_id' => 'required',
            'location' => 'sometimes',
        ];
    }
}
