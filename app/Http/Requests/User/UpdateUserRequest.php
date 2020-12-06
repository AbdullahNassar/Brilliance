<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;

class UpdateUserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = [
            'image' => 'mimes:jpeg,jpg,png|max:20000|dimensions:min_width=500,min_height=500',
            'role' => 'required|exists:roles,name',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ];
        return $rules;
    }
}
