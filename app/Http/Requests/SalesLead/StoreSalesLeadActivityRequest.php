<?php

namespace App\Http\Requests\SalesLead;

use App\Http\Requests\BaseRequest;

class StoreSalesLeadActivityRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'status' => 'required',
            'next_call' => 'required',
            'notes' => 'required',
            'sales_id'=>'required|exists:users,id',
        ];
    }
}
