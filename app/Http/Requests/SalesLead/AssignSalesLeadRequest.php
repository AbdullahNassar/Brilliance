<?php

namespace App\Http\Requests\SalesLead;

use App\Http\Requests\BaseRequest;

class AssignSalesLeadRequest extends BaseRequest
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
