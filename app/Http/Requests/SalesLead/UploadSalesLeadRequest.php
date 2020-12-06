<?php

namespace App\Http\Requests\SalesLead;

use App\Http\Requests\BaseRequest;

class UploadSalesLeadRequest extends BaseRequest
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
