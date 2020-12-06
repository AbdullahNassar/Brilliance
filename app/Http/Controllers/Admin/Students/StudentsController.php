<?php

namespace App\Http\Controllers\Admin\Students;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Http\Requests\Student\StoreStudentDocumentRequest;
use App\Helpers\StudentHelper;
use App\Helpers\EventModel;
use App\Student;
use App\StudentRequiredDocument;
use App\StudentDocument;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Auth;
use Calendar;

class StudentsController extends MainController
{
    public $model = Student::class;

    public function insert(StoreStudentRequest $request){
        $student = StudentHelper::addStudent($request);
        if($student)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateStudentRequest $request){
        $id = $request->id;
        $student = StudentHelper::editStudent($request,$id);
        if($student)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function upload(StoreStudentDocumentRequest $request){
        $old = StudentDocument::where('id',$request['document_id'])
                    ->where('student_id',$request['id'])->first();
        if($old)
        return json_encode($this->respondWithError(trans('messages.old')));

        $document = StudentHelper::addStudentDocument($request);
        if($document)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new StudentDocument))
        ])));
    }

    public static function index(){
        $students = Student::all();
        return view('admin.pages.students.index.index', compact('students'));
    }

    public static function profile($id){
        $student = Student::find($id);
        if($student)
        return view('admin.pages.students.profile.index', compact('student'));
        else
        return redirect('/admin/students');
    }

    public static function add(){
        return view('admin.pages.students.add.index');
    }

    public static function edit($id){
        $ids = array();
        $count = 0;
        $student = Student::find($id);
        $student_documents = $student->studentDocuments;
        $documents = StudentRequiredDocument::all();
        foreach($student_documents as $d){
            $ids[$count] = $d->document_id;
            $count++;
        }
        $student_required_documents = StudentRequiredDocument::all()->whereNotIn('id', $ids);
        if($student)
        return view('admin.pages.students.edit.index', compact('student','student_documents','student_required_documents','documents'));
        else
        return redirect('/admin/students');
    }

    public static function schedule($id){
        $student = Student::find($id);
        if($student)
        return view('admin.pages.students.index.calendar', compact('student'));
        else
        return redirect('/admin/students');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$student = ($this->model)::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        Student::where('id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }
}