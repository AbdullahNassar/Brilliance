<?php

namespace App\Http\Requests\Hall;

use App\Http\Requests\BaseRequest;

class UpdateHallRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

		$rules = [
            'name' => 'required|min:3|max:30',
        ];
        return $rules;
    }
}
