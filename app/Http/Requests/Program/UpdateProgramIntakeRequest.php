<?php

namespace App\Http\Requests\Program;

use App\Http\Requests\BaseRequest;

class UpdateProgramIntakeRequest extends BaseRequest
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
            'name' => 'required|min:3',
            'status'=>'required',
            'start'=>'required',
        ];
        return $rules;
    }
}
