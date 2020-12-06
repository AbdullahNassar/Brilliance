<?php

namespace App\Http\Requests\Student;

use App\Http\Requests\BaseRequest;

class StoreStudentDocumentRequest extends BaseRequest
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
            'document_id' => 'required|exists:student_required_documents,id',
        ];
    }
}
