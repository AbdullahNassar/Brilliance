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
            'platform' => 'required|min:3|max:30',
            'full_name' => 'required|min:3|max:30',
            'job_title' => 'required|min:3|max:30',
            'company_name' => 'required|min:3|max:30',
            'phone_number' => 'required|min:3|max:30',
            'email' => 'required|email|min:3|max:30',
            'marketing_id'=>'required|exists:users,id',
        ];
    }
}
