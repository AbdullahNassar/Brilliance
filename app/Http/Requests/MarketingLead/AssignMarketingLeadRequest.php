<?php

namespace App\Http\Requests\MarketingLead;

use App\Http\Requests\BaseRequest;

class AssignMarketingLeadRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sales_id'=>'required|exists:users,id',
        ];
    }
}
