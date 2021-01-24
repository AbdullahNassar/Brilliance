<?php

namespace App\Http\Requests\MarketingLead;

use App\Http\Requests\BaseRequest;

class UploadMarketingLeadRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required',
        ];
    }
}
