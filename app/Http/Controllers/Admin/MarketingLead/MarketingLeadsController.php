<?php

namespace App\Http\Controllers\Admin\MarketingLead;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\MarketingLead\StoreMarketingLeadRequest;
use App\Http\Requests\MarketingLead\UpdateMarketingLeadRequest;
use App\Http\Requests\MarketingLead\UploadMarketingLeadRequest;
use App\Http\Requests\MarketingLead\AssignMarketingLeadRequest;
use App\Helpers\MarketingLeadHelper;
use App\MarketingLead;
use App\SalesLead;
use App\User;
use Illuminate\Http\Request;

class MarketingLeadsController extends MainController
{
    public $model = MarketingLead::class;

    public function insert(StoreMarketingLeadRequest $request){
        $lead = MarketingLeadHelper::addMarketingLead($request);
        if($lead)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateMarketingLeadRequest $request){
        $id = $request->marketing_id;
        $lead = MarketingLeadHelper::editMarketingLead($request,$id);
        if($lead)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function insertData(UploadMarketingLeadRequest $request){
        $lead = MarketingLeadHelper::insertData($request);
        if($lead)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function index(){
        $leads = MarketingLead::all();
        $users = User::where('role','Sales')->get();
        return view('admin.pages.marketing.index.index', compact('leads','users'));
    }

    public function add(){
        return view('admin.pages.marketing.add.index');
    }

    public function upload(){
        return view('admin.pages.marketing.upload.index');
    }

    public function edit($id){
        $lead = MarketingLead::find($id);
        if($lead)
        return view('admin.pages.marketing.edit.index', compact('lead'));
        else
        return redirect('/admin/marketing');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$MarketingLead = MarketingLead::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        MarketingLead::where('id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function assigned(){
        $leads = MarketingLead::where('status',1)->get();
        return view('admin.pages.marketing.index.index', compact('leads'));
    }

    public function unassigned(){
        $leads = MarketingLead::where('status',0)->get();
        $users = User::where('role','Sales Manager')->get();
        return view('admin.pages.marketing.index.index', compact('leads','users'));
    }

    public function assign(AssignMarketingLeadRequest $request){
        $leads = MarketingLead::where('status',0)->get();
        foreach($leads as $lead){
            if($request['check'.$lead->id] == 1 && $request['checked'.$lead->id] == $lead->id){
                $phone_number = SalesLead::where('phone_number',$lead->phone_number)->first();
                $email = SalesLead::where('email',$lead->email)->first();
                if(!$phone_number && !$email){
                    MarketingLead::where('id',$lead->id)->update([
                        'status' => 1
                    ]);
                    SalesLead::create([
                        'created_time' => $lead->created_time,
                        'campaign_name' => $lead->campaign_name,
                        'form_name' => $lead->form_name,
                        'platform' => $lead->platform,
                        'full_name' => $lead->full_name,
                        'job_title' => $lead->job_title,
                        'company_name' => $lead->company_name,
                        'phone_number' => $lead->phone_number,
                        'email' => $lead->email,
                        'sales_id' => $request->sales_id,
                        'program_id' => $lead->program_id,
                        'diplom_id' => $lead->diplom_id,
                        'status' => 0
                    ]);
                }
            }
        }
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new SalesLead))
        ])));
    }
}