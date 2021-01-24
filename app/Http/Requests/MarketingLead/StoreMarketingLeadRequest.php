<?php

namespace App\Http\Requests\MarketingLead;

use App\Http\Requests\BaseRequest;

class StoreMarketingLeadRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'platform' => 'required',
            'full_name' => 'required',
            'job_title' => 'required',
            'company_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'marketing_id'=>'required|exists:users,id',
        ];
    }
}
