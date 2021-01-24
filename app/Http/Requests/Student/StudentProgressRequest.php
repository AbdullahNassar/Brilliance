<?php

namespace App\Http\Requests\Student;

use App\Http\Requests\BaseRequest;

class StudentProgressRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => 'required',
            'student_id' => 'required|exists:students,id',
            'notes' => 'sometimes',
        ];
    }
}
