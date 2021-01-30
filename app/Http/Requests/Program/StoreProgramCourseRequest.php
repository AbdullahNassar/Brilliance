<?php

namespace App\Http\Requests\Program;

use App\Http\Requests\BaseRequest;

class StoreProgramCourseRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

		$rules = [
            'program_id' => 'required|exists:programs,id',
            'name' => 'required|min:3|max:30',
            'credits' => 'required',
        ];
        return $rules;
    }
}
