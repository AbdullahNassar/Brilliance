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
            'email1'=>'required|email|unique:students',
            'mobile1'=>'required|unique:students',
            'lead_id'=>'required',
            'user_id'=>'required',
        ];
    }
}
