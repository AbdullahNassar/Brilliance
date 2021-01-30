@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Student Payment')
@section('styles')
    <link href="{{asset('vendors/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/bootstrap-summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jt.timepicker/jquery.timepicker.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/spectrum/spectrum.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">
    
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('vendors/css/bracket.css')}}">
    <link href="{{asset('vendors/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/css/float-labels.css')}}" rel="stylesheet">
@endsection
@php $key = 0; @endphp
@section('content')
    <!-- br-mainpanel -->
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('dashboard')}}">Brilliance</a>
            <a class="breadcrumb-item" href="{{route('admin.students')}}">Students</a>
            <span class="breadcrumb-item active">Student Payment Form</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Student Payment Form</h4>
        <p class="mg-b-0">Forms are used to collect payment information with different element types of input, select, checkboxes, radios and more.</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          @if(Route::currentRouteName()=='applicants.pay') 
          <h4 style="color:#000;">Applicant Name : {{$student->name}} {{$student->middle_name}} {{$student->last_name}}</h4>
          @elseif(Route::currentRouteName()=='students.pay')
          <h4 style="color:#000;">Student Name : {{$student->name}} {{$student->middle_name}} {{$student->last_name}}</h4>
          @endif          
          <div class="form-layout form-layout-1">
            <div class="row mg-b-25">
              <div class="col-lg-12">
                <div class="bd bd-gray-300 rounded table-responsive">
                  <table class="table mg-b-0">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Installement</th>
                        <th>Paid/Amount in EGP</th>
                        <th>Paid/Amount in Euro</th>
                        <th>Paid/Amount in USD</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($deleted as $payment)
                        <tr>
                          <td>{{$payment->date}}</td>
                          <td>{{$payment->name}}</td>
                          <td>@if($payment->egp_amount > 0) {{$payment->egp_paid}}/{{$payment->egp_amount}} @endif @if($payment->egp_balance > 0) (Remaining : {{$payment->egp_balance}}) @endif</td>
                          <td>@if($payment->euro_amount > 0) {{$payment->euro_paid}}/{{$payment->euro_amount}} @endif @if($payment->euro_balance > 0) (Remaining : {{$payment->euro_balance}}) @endif</td>
                          <td>@if($payment->usd_amount > 0) {{$payment->usd_paid}}/{{$payment->usd_amount}} @endif @if($payment->usd_balance > 0) (Remaining : {{$payment->usd_balance}}) @endif</td>
                          <td>
                            Deleted
                          </td>
                        </tr>
                      @endforeach
                      @foreach($payments as $payment)
                        <tr>
                          <td>{{$payment->date}}</td>
                          <td>{{$payment->name}}</td>
                          <td>@if($payment->egp_amount > 0) {{$payment->egp_paid}}/{{$payment->egp_amount}} @endif @if($payment->egp_balance > 0) (Remaining : {{$payment->egp_balance}}) @endif</td>
                          <td>@if($payment->euro_amount > 0) {{$payment->euro_paid}}/{{$payment->euro_amount}} @endif @if($payment->euro_balance > 0) (Remaining : {{$payment->euro_balance}}) @endif</td>
                          <td>@if($payment->usd_amount > 0) {{$payment->usd_paid}}/{{$payment->usd_amount}} @endif @if($payment->usd_balance > 0) (Remaining : {{$payment->usd_balance}}) @endif</td>
                          <td>
                            <label class="ckbox">
                              <input disabled id="ckbox{{$loop->index+1}}" type="checkbox" @if($payment->paid == 1) checked @endif>
                              <span>Paid</span>
                            </label>
                          </td>
                        </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <form class="parsley-style-1" id="pay_form" method="post">
              {{csrf_field()}}
              <input type="hidden" value="{{$student->id}}" name="student_id">
              <input type="hidden" value="{{$now}}" name="date">
              <div class="row mg-b-25 payment">
                <div class="col-lg-3" id="remove_payment1">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <label class="control-label">Payment Name</label>
                    <select class="form-control" name="payments[{{$key}}][payment_id]">
                          <option></option>
                          @foreach($payments as $payment)
                          @if($payment->paid != 1)
                          <option value="{{$payment->id}}">{{$payment->name}}</option>
                          @endif
                          @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-lg-2" id="remove_payment2">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <label class="control-label">Date</label>
                    <input type="text" class="form-control datepicker dpd" autocomplete="off" value="{{$now}}" disabled>
                  </div>
                </div>
                <div class="col-lg-2" id="remove_payment3">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <label class="control-label">Euro = EGP</label>
                    <input type="number" class="form-control" name="payments[{{$key}}][egp_paid]" autocomplete="off">
                  </div>
                </div>
                <div class="col-lg-2" id="remove_payment4">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <label class="control-label">Euro</label>
                    <input type="number" class="form-control" name="payments[{{$key}}][euro_paid]" autocomplete="off">
                  </div>
                </div>
                <div class="col-lg-2" id="remove_payment5">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <label class="control-label">USD</label>
                    <input type="number" class="form-control" name="payments[{{$key}}][usd_paid]" autocomplete="off">
                  </div>
                </div>
                <div class="col-lg-1">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <input type="hidden" class="form-control" name="num3" id="num3"  value="1"/>
                    <a class="btn btn-outline-primary add_form_field3"><i class="fa fa-plus"></i></a>
                  </div>
                </div>
                <div id="old_remove_payment_button" class="col-lg-1">
                </div>
              </div>
              <div class="row mg-b-25 cash">
              <div class="col-lg-12">
              <h4>Cash Received</h4>
              </div>
              <div class="col-lg-3" id="remove_cash1">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <label class="control-label">Description</label>
                    <select class="form-control" name="cash[{{$key}}][description]">
                          <option></option>
                          @foreach($payments as $payment)
                          @if($payment->paid != 1)
                          <option value="{{$payment->name}}">{{$payment->name}}</option>
                          @endif
                          @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-lg-3" id="remove_cash2">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <label class="control-label">Type</label>
                    <select class="form-control" name="cash[{{$key}}][type]">
                          <option></option>
                          <option value="cash">Cash</option>
                          <option value="pos">POS</option>
                          <option value="bank">Bank Transfer</option>
                          <option value="online">Online</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-3" id="remove_cash3">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <label class="control-label">Currency</label>
                    <select class="form-control" name="cash[{{$key}}][currency]">
                          <option></option>
                          <option value="egp">EGP</option>
                          <option value="euro">Euro</option>
                          <option value="usd">USD</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-2" id="remove_cash4">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <label class="control-label">Amount</label>
                    <input type="number" class="form-control" name="cash[{{$key}}][amount]" autocomplete="off">
                  </div>
                </div>
                <div class="col-lg-1">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <input type="hidden" class="form-control" name="num" id="num"  value="1"/>
                    <a class="btn btn-outline-primary add_form_field"><i class="fa fa-plus"></i></a>
                  </div>
                </div>
                <div id="old_remove_cash_button" class="col-lg-1">
                </div>
              </div>
              <div class="row mg-b-25">
                <div class="col-lg-12">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
            </form>
          </div><!-- form-layout -->
        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->   
@endsection
@include('admin.pages.students.pay.scripts')