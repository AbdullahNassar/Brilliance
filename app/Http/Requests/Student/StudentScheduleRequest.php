<?php

namespace App\Http\Requests\Student;

use App\Http\Requests\BaseRequest;

class StudentScheduleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'service' => 'required',
            'notes' => 'sometimes',
            'program_id' => 'sometimes|exists:programs,id',
            'doctor_id' => 'sometimes|exists:doctors,id',
            'hall_id' => 'sometimes|exists:halls,id',
            'program_intake_id' => 'sometimes|exists:program_intakes,id',
            'program_course_id' => 'sometimes|exists:program_courses,id',
            'diplom_id' => 'sometimes|exists:diploms,id',
            'diplom_intake_id' => 'sometimes|exists:diplom_intakes,id',
            'diplom_course_id' => 'sometimes|exists:diplom_courses,id',
            'schedules'=>'required|array',
            'schedules.*.date' => 'required',
            'schedules.*.time_from' => 'required',
            'schedules.*.time_to' => 'required',
        ];
    }
}
