<?php

namespace App\Http\Requests\Doctor;

use App\Http\Requests\BaseRequest;

class UpdateDoctorRequest extends BaseRequest
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
            'image' => 'sometimes|mimes:jpeg,jpg,png|max:20000|dimensions:min_width=500,min_height=500',
            'email' => 'required',
            'mobile' => 'required',
            'national_id' => 'required',
        ];
    }
}
