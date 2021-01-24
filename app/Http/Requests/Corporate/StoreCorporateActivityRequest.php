<?php

namespace App\Http\Requests\Corporate;

use App\Http\Requests\BaseRequest;

class StoreCorporateActivityRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'proposal' => 'sometimes',
            'document' => 'sometimes',
            'service' => 'required',
            'status' => 'required',
            'next_call' => 'sometimes',
            'user_id' => 'required|exists:users,id',
            'program_id'=>'sometimes|exists:programs,id',
            'diplom_id' => 'sometimes|exists:diploms,id',
            'corporate_id' => 'sometimes|exists:corporates,id',
            'notes' => 'required',
            'training_course_id' => 'sometimes|exists:training_courses,id',
        ];
    }
}
