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
            'source' => 'required',
            'source_note' => 'sometimes|max:255',
            'name' => 'required',
            'logo' => 'required|mimes:jpeg,jpg,png|max:20000',
            'industry' => 'required',
            'street' => 'required',
            'area' => 'required',
            'city' => 'required',
            'landmark' => 'required',
            'country' => 'required',
            'website' => 'required',
            'email' => 'required|unique:corporates',
            'mobile' => 'required|unique:corporates',
            'fax' => 'required',
            'contacts'=>'sometimes|array',
            'contacts.*.name' => 'sometimes',
            'contacts.*.email' => 'sometimes',
            'contacts.*.position' => 'sometimes',
            'contacts.*.mobile' => 'sometimes',
            'contacts.*.default' => 'sometimes',
        ];
    }
}
