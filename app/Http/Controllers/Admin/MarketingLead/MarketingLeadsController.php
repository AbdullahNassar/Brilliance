<?php

namespace App\Http\Controllers\Admin\MarketingLead;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\MarketingLead\StoreMarketingLeadRequest;
use App\Http\Requests\MarketingLead\UpdateMarketingLeadRequest;
use App\Http\Requests\MarketingLead\UploadMarketingLeadRequest;
use App\Http\Requests\MarketingLead\AssignMarketingLeadRequest;
use App\Helpers\MarketingLeadHelper;
use App\MarketingLead;
use App\SalesTicket;
use App\SalesLead;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Carbon;

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
        $id = $request->lead_id;
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
        $leads = MarketingLead::orderBy('created_at','DESC')->get();
        $users = User::where('role','sales-manager')->get();
        return view('admin.pages.marketing.index.index', compact('leads','users'));
    }

    public function leadsReport(){
        $leads = MarketingLead::all();
        return view('admin.pages.reports.marketing.leads.index', compact('leads'));
    }

    public function ticketsReport(){
        $leads = SalesTicket::all();
        return view('admin.pages.reports.marketing.tickets.index', compact('leads'));
    }

    public function tickets(){
        $leads = SalesTicket::all();
        return view('admin.pages.marketing.tickets.index', compact('leads'));
    }

    public static function sales(){
        $leads = SalesLead::all();
        $follow = SalesLead::where('activity_status','Time/ Not Decided')->count();
        $potential = SalesLead::where('activity_status','Potential')->count();
        $hold = SalesLead::where('activity_status','Hold')->count();
        $noanswer = SalesLead::where('activity_status','No Answer')->count();
        $interested = SalesLead::where('activity_status','Interested')->count();
        $outofreach = SalesLead::where('activity_status','Out Of Reach')->count();
        $closed = SalesLead::where('activity_status','Not Interested')->count();
        $warm = SalesLead::where('temperature','Warm')->count();
        $cold = SalesLead::where('temperature','Cold')->count();
        $hot = SalesLead::where('temperature','Hot')->count();
        return view('admin.pages.marketing.sales.index', compact('leads','follow','potential','hold','noanswer','interested','outofreach','closed','hot','warm','cold'));
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
        $users = User::where('role','sales-manager')->get();
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
                        'manager_id' => $request->sales_id,
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

    public static function followleads(){
        $leads = SalesLead::where('activity_status','Time/ Not Decided')->get();
        $follow = SalesLead::where('activity_status','Time/ Not Decided')->count();
        $potential = SalesLead::where('activity_status','Potential')->count();
        $hold = SalesLead::where('activity_status','Hold')->count();
        $noanswer = SalesLead::where('activity_status','No Answer')->count();
        $interested = SalesLead::where('activity_status','Interested')->count();
        $outofreach = SalesLead::where('activity_status','Out Of Reach')->count();
        $closed = SalesLead::where('activity_status','Not Interested')->count();
        $warm = SalesLead::where('temperature','Warm')->count();
        $cold = SalesLead::where('temperature','Cold')->count();
        $hot = SalesLead::where('temperature','Hot')->count();
        return view('admin.pages.marketing.sales.index', compact('leads','follow','potential','hold','noanswer','interested','outofreach','closed','hot','warm','cold'));
    }

    public static function potentialleads(){
        $leads = SalesLead::where('activity_status','Potential')->get();
        $follow = SalesLead::where('activity_status','Time/ Not Decided')->count();
        $potential = SalesLead::where('activity_status','Potential')->count();
        $hold = SalesLead::where('activity_status','Hold')->count();
        $noanswer = SalesLead::where('activity_status','No Answer')->count();
        $interested = SalesLead::where('activity_status','Interested')->count();
        $outofreach = SalesLead::where('activity_status','Out Of Reach')->count();
        $closed = SalesLead::where('activity_status','Not Interested')->count();
        $warm = SalesLead::where('temperature','Warm')->count();
        $cold = SalesLead::where('temperature','Cold')->count();
        $hot = SalesLead::where('temperature','Hot')->count();
        return view('admin.pages.marketing.sales.index', compact('leads','follow','potential','hold','noanswer','interested','outofreach','closed','hot','warm','cold'));
    }

    public static function holdleads(){
        $leads = SalesLead::where('activity_status','Hold')->get();
        $follow = SalesLead::where('activity_status','Time/ Not Decided')->count();
        $potential = SalesLead::where('activity_status','Potential')->count();
        $hold = SalesLead::where('activity_status','Hold')->count();
        $noanswer = SalesLead::where('activity_status','No Answer')->count();
        $interested = SalesLead::where('activity_status','Interested')->count();
        $outofreach = SalesLead::where('activity_status','Out Of Reach')->count();
        $closed = SalesLead::where('activity_status','Not Interested')->count();
        $warm = SalesLead::where('temperature','Warm')->count();
        $cold = SalesLead::where('temperature','Cold')->count();
        $hot = SalesLead::where('temperature','Hot')->count();
        return view('admin.pages.marketing.sales.index', compact('leads','follow','potential','hold','noanswer','interested','outofreach','closed','hot','warm','cold'));
    }

    public static function noAnswerleads(){
        $leads = SalesLead::where('activity_status','No Answer')->get();
        $follow = SalesLead::where('activity_status','Time/ Not Decided')->count();
        $potential = SalesLead::where('activity_status','Potential')->count();
        $hold = SalesLead::where('activity_status','Hold')->count();
        $noanswer = SalesLead::where('activity_status','No Answer')->count();
        $interested = SalesLead::where('activity_status','Interested')->count();
        $outofreach = SalesLead::where('activity_status','Out Of Reach')->count();
        $closed = SalesLead::where('activity_status','Not Interested')->count();
        $warm = SalesLead::where('temperature','Warm')->count();
        $cold = SalesLead::where('temperature','Cold')->count();
        $hot = SalesLead::where('temperature','Hot')->count();
        return view('admin.pages.marketing.sales.index', compact('leads','follow','potential','hold','noanswer','interested','outofreach','closed','hot','warm','cold'));
    }

    public static function interestedleads(){
        $leads = SalesLead::where('activity_status','Interested')->get();
        $follow = SalesLead::where('activity_status','Time/ Not Decided')->count();
        $potential = SalesLead::where('activity_status','Potential')->count();
        $hold = SalesLead::where('activity_status','Hold')->count();
        $noanswer = SalesLead::where('activity_status','No Answer')->count();
        $interested = SalesLead::where('activity_status','Interested')->count();
        $outofreach = SalesLead::where('activity_status','Out Of Reach')->count();
        $closed = SalesLead::where('activity_status','Not Interested')->count();
        $warm = SalesLead::where('temperature','Warm')->count();
        $cold = SalesLead::where('temperature','Cold')->count();
        $hot = SalesLead::where('temperature','Hot')->count();
        return view('admin.pages.marketing.sales.index', compact('leads','follow','potential','hold','noanswer','interested','outofreach','closed','hot','warm','cold'));
    }

    public static function outOfReachleads(){
        $leads = SalesLead::where('activity_status','Out Of Reach')->get();
        $follow = SalesLead::where('activity_status','Time/ Not Decided')->count();
        $potential = SalesLead::where('activity_status','Potential')->count();
        $hold = SalesLead::where('activity_status','Hold')->count();
        $noanswer = SalesLead::where('activity_status','No Answer')->count();
        $interested = SalesLead::where('activity_status','Interested')->count();
        $outofreach = SalesLead::where('activity_status','Out Of Reach')->count();
        $closed = SalesLead::where('activity_status','Not Interested')->count();
        $warm = SalesLead::where('temperature','Warm')->count();
        $cold = SalesLead::where('temperature','Cold')->count();
        $hot = SalesLead::where('temperature','Hot')->count();
        return view('admin.pages.marketing.sales.index', compact('leads','follow','potential','hold','noanswer','interested','outofreach','closed','hot','warm','cold'));
    }

    public static function closedleads(){
        $leads = SalesLead::where('activity_status','Not Interested')->get();
        $follow = SalesLead::where('activity_status','Time/ Not Decided')->count();
        $potential = SalesLead::where('activity_status','Potential')->count();
        $hold = SalesLead::where('activity_status','Hold')->count();
        $noanswer = SalesLead::where('activity_status','No Answer')->count();
        $interested = SalesLead::where('activity_status','Interested')->count();
        $outofreach = SalesLead::where('activity_status','Out Of Reach')->count();
        $closed = SalesLead::where('activity_status','Not Interested')->count();
        $warm = SalesLead::where('temperature','Warm')->count();
        $cold = SalesLead::where('temperature','Cold')->count();
        $hot = SalesLead::where('temperature','Hot')->count();
        return view('admin.pages.marketing.sales.index', compact('leads','follow','potential','hold','noanswer','interested','outofreach','closed','hot','warm','cold'));
    }

    public static function warm(){
        $leads = SalesLead::where('temperature','Warm')->get();
        $follow = SalesLead::where('activity_status','Time/ Not Decided')->count();
        $potential = SalesLead::where('activity_status','Potential')->count();
        $hold = SalesLead::where('activity_status','Hold')->count();
        $noanswer = SalesLead::where('activity_status','No Answer')->count();
        $interested = SalesLead::where('activity_status','Interested')->count();
        $outofreach = SalesLead::where('activity_status','Out Of Reach')->count();
        $closed = SalesLead::where('activity_status','Not Interested')->count();
        $warm = SalesLead::where('temperature','Warm')->count();
        $cold = SalesLead::where('temperature','Cold')->count();
        $hot = SalesLead::where('temperature','Hot')->count();
        return view('admin.pages.marketing.sales.index', compact('leads','follow','potential','hold','noanswer','interested','outofreach','closed','hot','warm','cold'));
    }

    public static function cold(){
        $leads = SalesLead::where('temperature','Cold')->get();
        $follow = SalesLead::where('activity_status','Time/ Not Decided')->count();
        $potential = SalesLead::where('activity_status','Potential')->count();
        $hold = SalesLead::where('activity_status','Hold')->count();
        $noanswer = SalesLead::where('activity_status','No Answer')->count();
        $interested = SalesLead::where('activity_status','Interested')->count();
        $outofreach = SalesLead::where('activity_status','Out Of Reach')->count();
        $closed = SalesLead::where('activity_status','Not Interested')->count();
        $warm = SalesLead::where('temperature','Warm')->count();
        $cold = SalesLead::where('temperature','Cold')->count();
        $hot = SalesLead::where('temperature','Hot')->count();
        return view('admin.pages.marketing.sales.index', compact('leads','follow','potential','hold','noanswer','interested','outofreach','closed','hot','warm','cold'));
    }

    public static function hot(){
        $leads = SalesLead::where('temperature','Hot')->get();
        $follow = SalesLead::where('activity_status','Time/ Not Decided')->count();
        $potential = SalesLead::where('activity_status','Potential')->count();
        $hold = SalesLead::where('activity_status','Hold')->count();
        $noanswer = SalesLead::where('activity_status','No Answer')->count();
        $interested = SalesLead::where('activity_status','Interested')->count();
        $outofreach = SalesLead::where('activity_status','Out Of Reach')->count();
        $closed = SalesLead::where('activity_status','Not Interested')->count();
        $warm = SalesLead::where('temperature','Warm')->count();
        $cold = SalesLead::where('temperature','Cold')->count();
        $hot = SalesLead::where('temperature','Hot')->count();
        return view('admin.pages.marketing.sales.index', compact('leads','follow','potential','hold','noanswer','interested','outofreach','closed','hot','warm','cold'));
    }

    public function approve($id){
        $ticket = SalesTicket::find($id);
        SalesTicket::where('id',$id)->update([
            'status' => 1,
        ]);
        $now = Carbon::now()->format('j-m-Y');
        SalesLead::create([
            'created_time' => $now,
            'campaign_name' => $ticket->campaign_name,
            'form_name' => $ticket->form_name,
            'platform' => $ticket->source,
            'full_name' => $ticket->full_name,
            'job_title' => $ticket->job_title,
            'company_name' => $ticket->company_name,
            'phone_number' => $ticket->phone_number,
            'email' => $ticket->email,
            'sales_id' => $ticket->sales_id,
            'program_id' => $ticket->program_id,
            'diplom_id' => $ticket->diplom_id,
            'status' => 0
        ]);
        return redirect()->back();
    }

    public function reject($id){
        SalesTicket::where('id',$id)->update([
            'status' => 2,
        ]);
        return redirect()->back();
    }
}