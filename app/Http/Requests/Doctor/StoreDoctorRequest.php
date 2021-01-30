<?php

namespace App\Http\Requests\Doctor;

use App\Http\Requests\BaseRequest;

class StoreDoctorRequest extends BaseRequest
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
            'image' => 'sometimes|mimes:jpeg,jpg,png|max:20000|dimensions:min_width=500,min_height=500',
            'email' => 'required|unique:doctors|min:3|max:30',
            'mobile' => 'required|unique:doctors|min:3|max:30',
            'national_id' => 'required|unique:doctors|min:3|max:30',
        ];
    }
}
