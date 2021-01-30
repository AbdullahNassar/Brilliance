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
            'source' => 'required|min:3|max:30',
            'study' => 'required|min:3|max:30',
            'full_name' => 'required|min:3|max:30',
            'job_title' => 'required|min:3|max:30',
            'company_name' => 'required|min:3|max:30',
            'phone_number' => 'required|min:3|max:30',
            'email' => 'required|min:3|max:30',
            'sales_id'=>'required|exists:users,id',
        ];
    }
}
