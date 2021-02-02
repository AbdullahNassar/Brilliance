<?php

namespace App\Http\Requests\Employee;

use App\Http\Requests\BaseRequest;

class StoreEmployeeRequest extends BaseRequest
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
            'image' => 'mimes:jpeg,jpg,png|max:20000|dimensions:min_width=500,min_height=500',
            'email1' => 'required|unique:employees|min:3|max:30',
            'gender' => 'required',
            'job' => 'sometimes',
            'mobile1' => 'required|unique:employees|min:3|max:30',
            'national_id' => 'required|unique:employees|min:3|max:30',
            'location' => 'sometimes',
        ];
    }
}
