<?php

namespace App\Http\Requests\SalesLead;

use App\Http\Requests\BaseRequest;

class StoreSalesLeadRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'created_time' => 'required',
            'campaign_name' => 'required|min:3|max:30',
            'form_name' => 'required|min:3|max:30',
            'platform' => 'required|min:1|max:30',
            'full_name' => 'required|min:3|max:30',
            'job_title' => 'required|min:3|max:30',
            'company_name' => 'required|min:3|max:30',
            'phone_number' => 'required|min:3|max:30',
            'email' => 'required|min:3|max:30',
            'study' => 'sometimes',
            'sales_id'=>'required|exists:users,id',
        ];
    }
}
