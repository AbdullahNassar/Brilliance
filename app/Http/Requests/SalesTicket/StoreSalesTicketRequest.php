<?php

namespace App\Http\Requests\SalesTicket;

use App\Http\Requests\BaseRequest;

class StoreSalesTicketRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'source' => 'required',
            'study' => 'required',
            'full_name' => 'required',
            'job_title' => 'required',
            'company_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'sales_id'=>'required|exists:users,id',
        ];
    }
}
