<?php

namespace App\Http\Requests\TrainingCourse;

use App\Http\Requests\BaseRequest;

class UpdateTrainingCourseRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'corporate_id'=>'required|exists:corporates,id',
            'category_id'=>'required|exists:training_categories,id',
        ];
    }
}
