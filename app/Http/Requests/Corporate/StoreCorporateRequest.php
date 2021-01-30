<?php

namespace App\Http\Requests\Corporate;

use App\Http\Requests\BaseRequest;

class StoreCorporateRequest extends BaseRequest
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
            'source_note' => 'sometimes|max:255',
            'name' => 'required|min:3|max:30',
            'logo' => 'sometimes|mimes:jpeg,jpg,png|max:20000',
            'industry' => 'required|min:3|max:50',
            'street' => 'required|min:3|max:50',
            'area' => 'required|min:3|max:50',
            'city' => 'required|min:3|max:50',
            'landmark' => 'required|min:3|max:50',
            'country' => 'required|min:3|max:50',
            'website' => 'required|min:3|max:50',
            'email' => 'required|email|min:3|max:50',
            'mobile' => 'required|min:3|max:50',
            'fax' => 'required|min:3|max:50',
            'contacts'=>'sometimes|array',
            'contacts.*.name' => 'sometimes',
            'contacts.*.email' => 'sometimes',
            'contacts.*.position' => 'sometimes',
            'contacts.*.mobile' => 'sometimes',
            'contacts.*.default' => 'sometimes',
        ];
    }
}
