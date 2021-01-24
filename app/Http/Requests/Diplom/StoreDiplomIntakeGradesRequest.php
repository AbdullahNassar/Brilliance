<?php

namespace App\Http\Requests\Diplom;

use App\Http\Requests\BaseRequest;

class StoreDiplomIntakeGradesRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		$rules = [
            'course_id' => 'required|exists:diplom_courses,id',
        ];
        return $rules;
    }
}
