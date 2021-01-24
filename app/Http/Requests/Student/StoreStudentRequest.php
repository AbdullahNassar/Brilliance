<?php

namespace App\Http\Requests\Student;

use App\Http\Requests\BaseRequest;

class StoreStudentRequest extends BaseRequest
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
            'email1' => 'required|unique:students',
            'gender' => 'required',
            'job' => 'sometimes',
            'mobile1' => 'required|unique:students',
            'national_id' => 'required|unique:students',
            'location' => 'sometimes',
        ];
    }
}
