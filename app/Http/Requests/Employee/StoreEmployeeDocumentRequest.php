<?php

namespace App\Http\Requests\Employee;

use App\Http\Requests\BaseRequest;

class StoreEmployeeDocumentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'statement' => 'required|mimes:jpeg,jpg,png,pdf|max:20000',
            'document_id' => 'required|exists:employee_required_documents,id',
        ];
    }
}
