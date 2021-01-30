<?php

namespace App\Http\Requests\Program;

use App\Http\Requests\BaseRequest;

class StoreProgramIntakeRequest extends BaseRequest
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
            'status'=>'required',
            'start'=>'required',
        ];
        return $rules;
    }
}
