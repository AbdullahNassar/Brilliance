<?php

namespace App\Http\Controllers\Admin\SalesTicket;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\SalesTicket\StoreSalesTicketRequest;
use App\Http\Requests\SalesTicket\UpdateSalesTicketRequest;
use App\Http\Requests\SalesTicket\UploadSalesTicketRequest;
use App\Http\Requests\SalesTicket\AssignSalesTicketRequest;
use App\Helpers\SalesTicketHelper;
use Illuminate\Http\Request;
use App\SalesTicket;
use App\SalesLead;
use App\Program;
use App\Diplom;
use App\User;
use Auth;

class SalesTicketsController extends MainController
{
    public $model = SalesTicket::class;

    public function insert(StoreSalesTicketRequest $request){
        $ticket = SalesTicketHelper::addSalesTicket($request);
        if($ticket)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateSalesTicketRequest $request){
        $id = $request->sales_id;
        $ticket = SalesTicketHelper::editSalesTicket($request,$id);
        if($ticket)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function insertData(UploadSalesTicketRequest $request){
        $ticket = SalesTicketHelper::insertData($request);
        if($ticket)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function index(){
        $tickets = SalesTicket::where('sales_id',Auth::user()->id)->get();
        $users = User::where('role','Sales')->get();
        return view('admin.pages.sales.ticket.index.index', compact('tickets','users'));
    }

    public function add(){
        $programs = Program::where('active',1)->get();
        $diploms = Diplom::where('active',1)->get();
        return view('admin.pages.sales.ticket.add.index',compact('programs','diploms'));
    }

    public function upload(){
        return view('admin.pages.sales.ticket.upload.index');
    }

    public function edit($id){
        $ticket = SalesTicket::find($id);
        if($ticket)
        return view('admin.pages.sales.ticket.edit.index', compact('lead'));
        else
        return redirect('/admin/sales');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$SalesTicket = SalesTicket::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        SalesTicket::where('id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function approved(){
        $tickets = SalesTicket::where('status',1)->where('sales_id',Auth::user()->id)->get();
        return view('admin.pages.sales.ticket.index.index', compact('tickets'));
    }

    public function rejected(){
        $tickets = SalesTicket::where('status',2)->where('sales_id',Auth::user()->id)->get();
        return view('admin.pages.sales.ticket.index.index', compact('tickets'));
    }

    public function pending(){
        $tickets = SalesTicket::where('status',0)->where('sales_id',Auth::user()->id)->get();
        return view('admin.pages.sales.ticket.index.index', compact('tickets'));
    }

    public function assign(AssignSalesTicketRequest $request){
        $tickets = SalesTicket::where('status',0)->get();
        foreach($tickets as $ticket){
            if($request['check'.$ticket->id] == 1 && $request['checked'.$ticket->id] == $ticket->id){
                $phone_number = SalesLead::where('phone_number',$ticket->phone_number)->first();
                $email = SalesLead::where('email',$ticket->email)->first();
                if(!$phone_number && !$email){
                    SalesTicket::where('id',$ticket->id)->update([
                        'status' => 1
                    ]);
                    SalesLead::create([
                        'created_time' => $ticket->created_time,
                        'campaign_name' => $ticket->campaign_name,
                        'form_name' => $ticket->form_name,
                        'platform' => $ticket->platform,
                        'full_name' => $ticket->full_name,
                        'job_title' => $ticket->job_title,
                        'company_name' => $ticket->company_name,
                        'phone_number' => $ticket->phone_number,
                        'email' => $ticket->email,
                        'sales_id' => $request->sales_id,
                        'program_id' => $ticket->program_id,
                        'diplom_id' => $ticket->diplom_id,
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