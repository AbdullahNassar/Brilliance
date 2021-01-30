<?php

namespace App\Http\Controllers\Admin\SalesLead;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\SalesLead\StoreSalesLeadRequest;
use App\Http\Requests\SalesLead\UpdateSalesLeadRequest;
use App\Http\Requests\SalesLead\UploadSalesLeadRequest;
use App\Http\Requests\SalesLead\AssignSalesLeadRequest;
use App\Http\Requests\SalesLead\ConvertRequest;
use App\Http\Requests\SalesLead\StoreSalesLeadActivityRequest;
use App\Helpers\SalesLeadHelper;
use Illuminate\Http\Request;
use App\SalesLead;
use App\SalesActivity;
use App\MarketingLead;
use App\Program;
use App\Diplom;
use App\Student;
use App\StudentCourse;
use App\User;
use Auth;
use DB;
use Carbon;

class SalesLeadsController extends MainController
{
    public $model = SalesLead::class;

    public function insert(StoreSalesLeadRequest $request){
        $lead = SalesLeadHelper::addSalesLead($request);
        if($lead)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function insertticket(StoreSalesLeadRequest $request){
        $lead = SalesLeadHelper::addSalesLead($request);
        if($lead)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateSalesLeadRequest $request){
        $id = $request->lead_id;
        $lead = SalesLeadHelper::editSalesLead($request,$id);
        if($lead)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function insertData(UploadSalesLeadRequest $request){
        $lead = SalesLeadHelper::insertData($request);
        if($lead)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public static function index(){
        $leads = SalesLead::where('status','!=',5)->where('activity_status','!=',"Not Interested")->orderBy('created_at','DESC')->get();
        return view('admin.pages.sales.index.index', compact('leads'));
    }

    public static function contacts(){
        $leads = SalesLead::get()->where('activity_status','=',"Not Interested")->orderBy('created_at','DESC');
        $applicants = DB::table('students')->where('deleted_at','!=',null)->get();
        return view('admin.pages.sales.contacts.index', compact('leads','applicants'));
    }

    public static function leadsReport(){
        $leads = SalesLead::orderBy('created_at','DESC')->get();
        return view('admin.pages.reports.sales.leads.index', compact('leads'));
    }

    public static function activitiesReport(){
        $activities = SalesActivity::orderBy('created_at','DESC')->get();
        return view('admin.pages.reports.sales.activities.index', compact('activities'));
    }

    public static function activity($id){
        $programs = Program::where('active',1)->get();
        $diploms = Diplom::where('active',1)->get();
        $lead = SalesLead::find($id);
        return view('admin.pages.sales.activity.index', compact('programs','diploms','lead'));
    }

    public static function manager(){
        $user = User::find(Auth::user()->id);
        $leads = SalesLead::where('manager_id',$user->id)->where('status','!=',5)->orderBy('created_at','DESC')->get();
        $users = User::where('role','sales')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }

    public static function advisors(){
        $leads = SalesLead::where('status','!=',5)->orderBy('created_at','DESC')->get();
        return view('admin.pages.sales.index.index', compact('leads'));
    }

    public static function advisor(){
        $user = User::find(Auth::user()->id);
        $leads = SalesLead::where('sales_id',$user->id)->where('status','!=',5)->orderBy('created_at','DESC')->get();
        $managers = User::where('role','sales-manager')->get();
        return view('admin.pages.sales.index.index', compact('leads','managers'));
    }

    public static function add(){
        $programs = Program::where('active',1)->get();
        $diploms = Diplom::where('active',1)->get();
        return view('admin.pages.sales.add.index', compact('programs','diploms'));
    }
    
    public static function ticket(){
        $programs = Program::where('active',1)->get();
        $diploms = Diplom::where('active',1)->get();
        return view('admin.pages.sales.add.index', compact('programs','diploms'));
    }

    public static function upload(){
        return view('admin.pages.sales.upload.index');
    }

    public static function edit($id){
        $programs = Program::where('active',1)->get();
        $diploms = Diplom::where('active',1)->get();
        $lead = SalesLead::find($id);
        if($lead)
        return view('admin.pages.sales.edit.index', compact('lead','programs','diploms'));
        else
        return redirect('/admin/sales');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$SalesLead = SalesLead::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        SalesLead::where('id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public static function assigned(){
        $leads = SalesLead::where('status',1)->orderBy('created_at','DESC')->get();
        $users = User::where('role','sales')->orWhere('role','sales-manager')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }

    public static function unassigned(){
        $leads = SalesLead::where('status','!=',1)->where('status','!=',5)->orderBy('created_at','DESC')->get();
        $users = User::where('role','sales')->orWhere('role','sales-manager')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }

    public function assign(AssignSalesLeadRequest $request){
        $now = Carbon::now()->format('j-m-Y');
        $leads = SalesLead::all();
        foreach($leads as $lead){
            if($request['check'.$lead->id] == 1 && $request['checked'.$lead->id] == $lead->id){
                SalesLead::where('id',$lead->id)->update([
                    'sales_id' => $request->sales_id,
                    'status' => $request->status,
                    'assign_date' => $now
                ]);
                SalesActivity::create([
                    'notes' => "Lead Assigned",
                    'sales_id' => $request->sales_id,
                    'manager_id' => Auth::user()->id,
                    'sales_lead_id' => $lead->id,
                ]);
            }
        }
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.assign',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function insertActivity(StoreSalesLeadActivityRequest $request){
        $activity = SalesLeadHelper::addSalesLeadActivity($request);
        if($activity)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function convert(ConvertRequest $request){
        $id = $request->lead_id;
        $lead = SalesLead::find($id);
        $student = Student::create([
            'name' => $lead->full_name,
            'job' => $lead->job_title,
            'mobile1' => $lead->phone_number,
            'email1' => $lead->email,
            'program_id' => $lead->program_id,
            'diplom_id' => $lead->diplom_id,
            'user_id' => $request->user_id,
            'lead_id' => $id,
        ]);
        if($request['program_id'] != null){
            $program = Program::find($request['program_id']);
            foreach($program->courses as $course){
                StudentCourse::create([
                    'program_course_id' => $course->id,
                    'student_id' => $student->id,
                ]);
            }
        }

        if($request['diplom_id'] != null){
            $diplom = Diplom::find($request['diplom_id']);
            foreach($diplom->courses as $course){
                StudentCourse::create([
                    'diplom_course_id' => $course->id,
                    'student_id' => $student->id,
                ]);
            }
        }
        $lead = SalesLead::where('id',$lead->id)->update([
            'status' => 5,
        ]);
        if($student)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new Student))
        ])));
    }

    public static function profile($id){
        $lead = SalesLead::find($id);
        $advisor = User::find($lead->sales_id);
        $activities = SalesActivity::where('sales_lead_id',$lead->id)->orderBy('created_at','DESC')->get();
        return view('admin.pages.sales.profile.index', compact('lead','advisor','activities'));
    }

    public static function follow(){
        $user = User::where('id',Auth::user()->id)->first();
        $leads = SalesLead::where('sales_id',$user->id)->where('activity_status','Time/ Not Decided')->where('status','!=',5)->orderBy('created_at','DESC')->get();
        $managers = User::where('role','sales-manager')->get();
        return view('admin.pages.sales.index.index', compact('leads','managers'));
    }

    public static function potential(){
        $user = User::where('id',Auth::user()->id)->first();
        $leads = SalesLead::where('sales_id',$user->id)->where('activity_status','Potential')->where('status','!=',5)->orderBy('created_at','DESC')->get();
        $managers = User::where('role','sales-manager')->get();
        return view('admin.pages.sales.index.index', compact('leads','managers'));
    }

    public static function hold(){
        $user = User::where('id',Auth::user()->id)->first();
        $leads = SalesLead::where('sales_id',$user->id)->where('activity_status','Hold')->where('status','!=',5)->orderBy('created_at','DESC')->get();
        $managers = User::where('role','sales-manager')->get();
        return view('admin.pages.sales.index.index', compact('leads','managers'));
    }

    public static function noAnswer(){
        $user = User::where('id',Auth::user()->id)->first();
        $leads = SalesLead::where('sales_id',$user->id)->where('activity_status','No Answer')->where('status','!=',5)->orderBy('created_at','DESC')->get();
        $managers = User::where('role','sales-manager')->get();
        return view('admin.pages.sales.index.index', compact('leads','managers'));
    }

    public static function interested(){
        $user = User::where('id',Auth::user()->id)->first();
        $leads = SalesLead::where('sales_id',$user->id)->where('activity_status','Interested')->where('status','!=',5)->orderBy('created_at','DESC')->get();
        $managers = User::where('role','sales-manager')->get();
        return view('admin.pages.sales.index.index', compact('leads','managers'));
    }

    public static function outOfReach(){
        $user = User::where('id',Auth::user()->id)->first();
        $leads = SalesLead::where('sales_id',$user->id)->where('activity_status','Out Of Reach')->where('status','!=',5)->orderBy('created_at','DESC')->get();
        $managers = User::where('role','sales-manager')->get();
        return view('admin.pages.sales.index.index', compact('leads','managers'));
    }

    public static function closed(){
        $user = User::where('id',Auth::user()->id)->first();
        $leads = SalesLead::where('sales_id',$user->id)->where('activity_status','Not Interested')->where('status','!=',5)->orderBy('created_at','DESC')->get();
        $managers = User::where('role','sales-manager')->get();
        return view('admin.pages.sales.index.index', compact('leads','managers'));
    }

    public static function followleads(){
        $users = User::where('role','sales')->get();
        $leads = SalesLead::where('activity_status','Time/ Not Decided')->where('status','!=',5)->orderBy('created_at','DESC')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }

    public static function potentialleads(){
        $users = User::where('role','sales')->get();
        $leads = SalesLead::where('activity_status','Potential')->where('status','!=',5)->orderBy('created_at','DESC')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }

    public static function holdleads(){
        $users = User::where('role','sales')->get();
        $leads = SalesLead::where('activity_status','Hold')->where('status','!=',5)->orderBy('created_at','DESC')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }

    public static function noAnswerleads(){
        $users = User::where('role','sales')->get();
        $leads = SalesLead::where('activity_status','No Answer')->where('status','!=',5)->orderBy('created_at','DESC')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }

    public static function interestedleads(){
        $users = User::where('role','sales')->get();
        $leads = SalesLead::where('activity_status','Interested')->where('status','!=',5)->orderBy('created_at','DESC')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }

    public static function outOfReachleads(){
        $users = User::where('role','sales')->get();
        $leads = SalesLead::where('activity_status','Out Of Reach')->where('status','!=',5)->orderBy('created_at','DESC')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }

    public static function closedleads(){
        $users = User::where('role','sales')->get();
        $leads = SalesLead::where('activity_status','Not Interested')->where('status','!=',5)->orderBy('created_at','DESC')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }
}