<?php

namespace App\Http\Requests\SalesLead;

use App\Http\Requests\BaseRequest;

class UpdateSalesLeadRequest extends BaseRequest
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
            'campaign_name' => 'required',
            'form_name' => 'required',
            'platform' => 'required',
            'full_name' => 'required',
            'job_title' => 'required',
            'company_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'study' => 'sometimes',
            'sales_id'=>'required|exists:users,id',
        ];
    }
}
