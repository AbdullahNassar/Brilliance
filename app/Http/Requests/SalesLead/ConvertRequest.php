<?php

namespace App\Http\Requests\SalesLead;

use App\Http\Requests\BaseRequest;

class ConvertRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email1'=>'required|email|unique:students|min:3|max:30',
            'mobile1'=>'required|unique:students|min:3|max:30',
            'lead_id'=>'required',
            'user_id'=>'required',
        ];
    }
}
