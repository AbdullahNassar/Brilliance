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
          <div class="form-layout form-layout-1">
            <form class="parsley-style-1" id="payment_form" method="post" data-parsley-validate>
                {{csrf_field()}}
                <div class="table-wrapper">
                    <table id="payment_datatable" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>Full Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Intake</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $item)
                                <tr>
                                    <th>
                                        <label class="ckbox">
                                            <input id="ckbox{{$item->id}}" name="check{{$item->id}}" type="checkbox">
                                            <span> </span>
                                        </label>
                                        <input value="{{$item->id}}" id="checked{{$item->id}}" name="checked{{$item->id}}" type="hidden">
                                    </th>
                                    <th><a href="{{ route('students.profile' , ['id' => $item->id]) }}">{{$item->name}} {{$item->middle_name}} {{$item->last_name}}</a></th>
                                    <th>{{$item->mobile1}}</th>
                                    <th>{{$item->email1}}</th>
                                    <th>@if($item->program_intake_id != null) {{$item->programintake->name}} @elseif($item->diplom_intake_id != null) {{$item->diplomintake->name}} @else Empty @endif</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><hr>
                <div class="row mg-b-25 payment">
                  <div class="col-lg-3" id="remove_payment1">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Payment Name</label>
                      <select class="form-control" name="payments[{{$key}}][name]">
                            <option></option>
                            <option value="Application Fees">Application Fees</option>
                            <option value="1st Installment">1st Installment</option>
                            <option value="2nd Installment">2nd Installment</option>
                            <option value="3rd Installment">3rd Installment</option>
                            <option value="4th Installment">4th Installment</option>
                            <option value="5th Installment">5th Installment</option>
                            <option value="6th Installment">6th Installment</option>
                            <option value="7th Installment">7th Installment</option>
                            <option value="8th Installment">8th Installment</option>
                            <option value="9th Installment">9th Installment</option>
                            <option value="10th Installment">10th Installment</option>
                            <option value="11th Installment">11th Installment</option>
                            <option value="12th Installment">12th Installment</option>
                            <option value="13th Installment">13th Installment</option>
                            <option value="14th Installment">14th Installment</option>
                            <option value="15th Installment">15th Installment</option>
                            <option value="16th Installment">16th Installment</option>
                            <option value="17th Installment">17th Installment</option>
                            <option value="18th Installment">18th Installment</option>
                            <option value="19th Installment">19th Installment</option>
                            <option value="20th Installment">20th Installment</option>
                            <option value="21th Installment">21th Installment</option>
                            <option value="22th Installment">22th Installment</option>
                            <option value="23th Installment">23th Installment</option>
                            <option value="24th Installment">24th Installment</option>
                            <option value="Graduation Fees">Graduation Fees</option>
                            <option value="Legalization Certificate">Legalization Certificate</option>
                            <option value="Caps & Growns Insurance">Caps & Growns Insurance</option>
                            <option value="Transcript">Transcript</option>
                            <option value="Make up Exam">Make up Exam</option>
                            <option value="Resubmission">Resubmission</option>
                            <option value="No Show in Final Exam">No Show in Final Exam</option>
                            <option value="Failed">Failed</option>
                            <option value="Rechecking Exam Paper">Rechecking Exam Paper</option>
                            <option value="Freezing">Freezing</option>
                            <option value="Photography">Photography</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-2" id="remove_payment2">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Date</label>
                      <input type="text" class="form-control datepicker dpd" name="payments[{{$key}}][date]" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-lg-2" id="remove_payment3">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Euro = EGP</label>
                      <input type="hidden" name="payments[{{$key}}][date]" value="{{$now}}">
                      <input type="text" class="form-control" name="payments[{{$key}}][egp_amount]" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-lg-2" id="remove_payment4">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Euro</label>
                      <input type="text" class="form-control" name="payments[{{$key}}][euro_amount]" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-lg-2" id="remove_payment5">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">USD</label>
                      <input type="text" class="form-control" name="payments[{{$key}}][usd_amount]" autocomplete="off">
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
@include('admin.pages.students.multipay.scripts')