<?php

namespace App\Http\Controllers\Admin\Employees;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Http\Requests\Employee\StoreEmployeeDocumentRequest;
use App\Helpers\EmployeeHelper;
use App\Employee;
use App\EmployeeRequiredDocument;
use App\EmployeeDocument;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Auth;
use Carbon;

class EmployeesController extends MainController
{
    public $model = Employee::class;

    public function insert(StoreEmployeeRequest $request){
        $employee = EmployeeHelper::addEmployee($request);
        if($employee)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateEmployeeRequest $request){
        $id = $request->id;
        $employee = EmployeeHelper::editEmployee($request,$id);
        if($employee)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function upload(StoreEmployeeDocumentRequest $request){
        $old = EmployeeDocument::where('document_id',$request['document_id'])
                    ->where('Employee_id',$request['id'])->first();
        if($old)
        return json_encode($this->respondWithError(trans('messages.old')));

        $document = EmployeeHelper::addEmployeeDocument($request);
        if($document)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new EmployeeDocument))
        ])));
    }

    public function index(){
        $employees = Employee::where('type','Employee')->get();
        return view('admin.pages.employees.index.index', compact('employees'));
    }

    public function profile($id){
        $count = 0;
        $employee = Employee::find($id);
        $employee_documents = $employee->EmployeeDocuments;
        $documents = EmployeeRequiredDocument::all();
        foreach($employee_documents as $d){
            $ids[$count] = $d->document_id;
            $count++;
        }
        if($employee)
        return view('admin.pages.employees.profile.index', compact('employee','employee_documents','documents'));
        else
        return redirect('/admin/employees');
    }

    public function uploadIndex($id){
        $ids = array();
        $count = 0;
        $employee = Employee::find($id);
        $employee_documents = $employee->EmployeeDocuments;
        $documents = EmployeeRequiredDocument::all();
        foreach($employee_documents as $d){
            $ids[$count] = $d->document_id;
            $count++;
        }
        $employee_required_documents = EmployeeRequiredDocument::all()->whereNotIn('id', $ids);
        if($employee)
        return view('admin.pages.employees.index.upload', compact('Employee','Employee_documents','Employee_required_documents','documents'));
        else
        return redirect('/admin/employees');
    }

    public function add(){
        return view('admin.pages.employees.add.index');
    }

    public function edit($id){
        $ids = array();
        $count = 0;
        $employee = Employee::find($id);
        $employee_documents = $employee->EmployeeDocuments;
        $documents = EmployeeRequiredDocument::all();
        foreach($employee_documents as $d){
            $ids[$count] = $d->document_id;
            $count++;
        }
        $employee_required_documents = EmployeeRequiredDocument::all()->whereNotIn('id', $ids);
        $last = Corporate::where('deleted_at','=', null)->orWhere('deleted_at','!=', null)->orderBy('created_at', 'desc')->first();

        if($employee)
        return view('admin.pages.employees.edit.index', compact('last','corporates','diplom_courses','diplom_intakes','program_courses','program_intakes','courses','diploms','programs','Employee','Employee_documents','Employee_required_documents','documents','Employee_corporates'));
        else
        return redirect('/admin/employees');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$employee = ($this->model)::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        Employee::where('id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }
}