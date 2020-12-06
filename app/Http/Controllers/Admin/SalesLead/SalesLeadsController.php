<?php

namespace App\Http\Controllers\Admin\SalesLead;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\SalesLead\StoreSalesLeadRequest;
use App\Http\Requests\SalesLead\UpdateSalesLeadRequest;
use App\Http\Requests\SalesLead\UploadSalesLeadRequest;
use App\Http\Requests\SalesLead\AssignSalesLeadRequest;
use App\Http\Requests\SalesLead\StoreSalesLeadActivityRequest;
use App\Helpers\SalesLeadHelper;
use Illuminate\Http\Request;
use App\SalesLead;
use App\SalesActivity;
use App\MarketingLead;
use App\Program;
use App\Diplom;
use App\User;

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
        $id = $request->sales_id;
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
        $leads = SalesLead::all();
        return view('admin.pages.sales.index.index', compact('leads'));
    }

    public static function activity($id){
        $programs = Program::where('active',1)->get();
        $diploms = Diplom::where('active',1)->get();
        $lead = SalesLead::find($id);
        return view('admin.pages.sales.activity.index', compact('programs','diploms','lead'));
    }

    public static function manager(){
        $leads = SalesLead::all();
        return view('admin.pages.sales.index.index', compact('leads'));
    }

    public static function advisors(){
        $leads = SalesLead::all();
        return view('admin.pages.sales.index.index', compact('leads'));
    }

    public static function advisor(){
        $user = User::where('role','sales')->first();
        $leads = SalesLead::where('sales_id',$user->id)->get();
        $managers = User::where('role','Sales Manager')->get();
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
        $leads = SalesLead::where('status',1)->get();
        $users = User::where('role','sales')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }

    public static function unassigned(){
        $leads = SalesLead::where('status','!=',1)->get();
        $users = User::where('role','sales')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }

    public function assign(AssignSalesLeadRequest $request){
        $leads = SalesLead::all();
        foreach($leads as $lead){
            if($request['check'.$lead->id] == 1 && $request['checked'.$lead->id] == $lead->id){
                SalesLead::where('id',$lead->id)->update([
                    'sales_id' => $request->sales_id,
                    'status' => $request->status
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

    public static function profile($id){
        $lead = SalesLead::find($id);
        $advisor = User::find($lead->sales_id);
        $activities = SalesActivity::where('sales_lead_id',$lead->id)->orderBy('created_at','DESC')->get();
        return view('admin.pages.sales.profile.index', compact('lead','advisor','activities'));
    }

    public static function follow(){
        $user = User::where('role','sales')->first();
        $leads = SalesLead::where('sales_id',$user->id)->where('activity_status','Follow Up')->get();
        $managers = User::where('role','Sales Manager')->get();
        return view('admin.pages.sales.index.index', compact('leads','managers'));
    }

    public static function potential(){
        $user = User::where('role','sales')->first();
        $leads = SalesLead::where('sales_id',$user->id)->where('activity_status','Potential')->get();
        $managers = User::where('role','Sales Manager')->get();
        return view('admin.pages.sales.index.index', compact('leads','managers'));
    }

    public static function hold(){
        $user = User::where('role','sales')->first();
        $leads = SalesLead::where('sales_id',$user->id)->where('activity_status','Hold')->get();
        $managers = User::where('role','Sales Manager')->get();
        return view('admin.pages.sales.index.index', compact('leads','managers'));
    }

    public static function noAnswer(){
        $user = User::where('role','sales')->first();
        $leads = SalesLead::where('sales_id',$user->id)->where('activity_status','No Answer')->get();
        $managers = User::where('role','Sales Manager')->get();
        return view('admin.pages.sales.index.index', compact('leads','managers'));
    }

    public static function interested(){
        $user = User::where('role','sales')->first();
        $leads = SalesLead::where('sales_id',$user->id)->where('activity_status','Interested')->get();
        $managers = User::where('role','Sales Manager')->get();
        return view('admin.pages.sales.index.index', compact('leads','managers'));
    }

    public static function outOfReach(){
        $user = User::where('role','sales')->first();
        $leads = SalesLead::where('sales_id',$user->id)->where('activity_status','Out Of Reach')->get();
        $managers = User::where('role','Sales Manager')->get();
        return view('admin.pages.sales.index.index', compact('leads','managers'));
    }

    public static function closed(){
        $user = User::where('role','sales')->first();
        $leads = SalesLead::where('sales_id',$user->id)->where('activity_status','Closed')->get();
        $managers = User::where('role','Sales Manager')->get();
        return view('admin.pages.sales.index.index', compact('leads','managers'));
    }

    public static function followleads(){
        $users = User::where('role','sales')->get();
        $leads = SalesLead::where('activity_status','Follow Up')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }

    public static function potentialleads(){
        $users = User::where('role','sales')->get();
        $leads = SalesLead::where('activity_status','Potential')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }

    public static function holdleads(){
        $users = User::where('role','sales')->get();
        $leads = SalesLead::where('activity_status','Hold')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }

    public static function noAnswerleads(){
        $users = User::where('role','sales')->get();
        $leads = SalesLead::where('activity_status','No Answer')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }

    public static function interestedleads(){
        $users = User::where('role','sales')->get();
        $leads = SalesLead::where('activity_status','Interested')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }

    public static function outOfReachleads(){
        $users = User::where('role','sales')->get();
        $leads = SalesLead::where('activity_status','Out Of Reach')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }

    public static function closedleads(){
        $users = User::where('role','sales')->get();
        $leads = SalesLead::where('activity_status','Closed')->get();
        return view('admin.pages.sales.index.index', compact('leads','users'));
    }
}