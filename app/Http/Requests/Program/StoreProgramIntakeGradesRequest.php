<?php

namespace App\Http\Requests\Program;

use App\Http\Requests\BaseRequest;

class StoreProgramIntakeGradesRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		$rules = [
            'course_id' => 'required|exists:program_courses,id',
        ];
        return $rules;
    }
}
