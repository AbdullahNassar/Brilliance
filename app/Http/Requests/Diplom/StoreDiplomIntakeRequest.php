<?php

namespace App\Http\Requests\Diplom;

use App\Http\Requests\BaseRequest;

class StoreDiplomIntakeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		$rules = [
            'diplom_id' => 'required|exists:diploms,id',
            'name' => 'required|min:3|max:30',
            'status'=>'required',
            'start'=>'required',
        ];
        return $rules;
    }
}
