@extends('admin.layouts.master')
@section('meta')
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bracket">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/bracket/img/bracket-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/bracket">
    <meta property="og:title" content="Bracket">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Students')
@section('styles')
    <link href="{{asset('vendors/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendors/lib/jquery-toggles/toggles-full.css')}}">
    <link href="{{asset('vendors/lib/bootstrap-summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jt.timepicker/jquery.timepicker.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendors/lib/spectrum/spectrum.css')}}">
    <link href="{{asset('vendors/lib/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('vendors/css/bracket.css')}}">
    <link href="{{asset('vendors/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/css/float-labels.css')}}" rel="stylesheet">
    
@endsection
@section('content')
@php $key = 0; @endphp
    <!-- br-mainpanel -->
    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="{{route('dashboard')}}">Brilliance</a>
        <a class="breadcrumb-item" href="{{route('admin.students')}}">Students</a>
        <span class="breadcrumb-item active">Add Student</span>
      </nav>
    </div><!-- br-pageheader -->
    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5">Student Form</h4>
      <p class="mg-b-0">Forms are used to collect user information with different element types of input, select, checkboxes, radios and more.</p>
    </div>
    <div class="br-pagebody">
      <div class="br-section-wrapper">
        <div class="form-layout form-layout-1">
          <div class="row mg-b-25">
            <div class="col-lg-12">
              <form class="parsley-style-1" id="student_form" method="post" enctype="multipart/form-data" data-parsley-validate>
                {{csrf_field()}}
                <input type="hidden" id="corp_id" value="{{$last->id}}">
                <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
                  <div class="card">
                      <div class="card-header" role="tab" id="headingOne">
                        <h6 class="mg-b-0">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                          aria-expanded="true" aria-controls="collapseOne" class="tx-gray-800 transition">
                          Student Information
                          </a>
                        </h6>
                      </div><!-- card-header -->
                  
                      <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="card-block pd-20">
                            <div class="row mg-b-25 align-items-center">
                              <div class="col-lg-12">
                                <div class="user-img-upload">
                                  <div class="fileUpload user-editimg">
                                      <span><i class="fa fa-camera"></i> Upload</span>
                                      <input type="file" id="imgInp" class="upload" name="image" value="{{$student->image}}">
                                  </div>
                                  @if($student->image != null)
                                  <img src="{{asset('images/users/'.$student->image)}}" id="blah" class="img-circle" alt="">
                                  @else
                                  <img src="{{asset('vendors/img/1.jpg')}}" id="blah" class="img-circle" alt="">
                                  @endif
                                  <p id="student_image">Student Image : (1000 x 1000)</p><hr>
                                </div>
                              </div><!-- col-12 -->
                              <div class="col-lg-6">
                                <div id="fnWrapper" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">First Name</label>
                                        <input type="hidden" value="{{$student->id}}" name="id">
                                        <input class="form-control" value="{{$student->name}}" type="text" name="name" data-parsley-class-handler="#fnWrapper" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Middle Name</label>
                                        <input class="form-control" value="{{$student->middle_name}}" type="text" name="middle_name" data-parsley-class-handler="#fnWrapper" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Last Name</label>
                                        <input class="form-control" value="{{$student->last_name}}" type="text" name="last_name" data-parsley-class-handler="#fnWrapper" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="d-flex">
                                  <div id="slWrapper" class="parsley-select" style="width:100%">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Gender</label>
                                        <select class="form-control pmd-select2 select2-show-search" name="gender" data-parsley-class-handler="#slWrapper"
                                          data-parsley-errors-container="#slErrorContainer" style="width:100%" required>
                                          <option value="Male" @if($student->gender == "Male") selected @endif>Male</option>
                                          <option value="Female" @if($student->gender == "Female") selected @endif>Female</option>
                                        </select>
                                        <div id="slErrorContainer"></div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div id="fnWrapper44" class="parsley-input">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                          <label class="control-label">Location</label>
                                          <input class="form-control" value="{{$student->location}}" type="text" name="locations" data-parsley-class-handler="#fnWrapper44" autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div id="lnWrapper33" class="parsley-input">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                          <label class="control-label">National ID</label>
                                          <input class="form-control" value="{{$student->national_id}}" type="text" name="national_id" data-parsley-class-handler="#lnWrapper33" required autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div id="fnWrapper1" class="parsley-input">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                          <label class="control-label">Mobile 1</label>
                                          <input class="form-control" value="{{$student->mobile1}}" type="text" name="mobile1" data-parsley-class-handler="#fnWrapper1" required autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div id="lnWrapper1" class="parsley-input">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                          <label class="control-label">Mobile 2</label>
                                          <input class="form-control" type="text" value="{{$student->mobile2}}" name="mobile2" data-parsley-class-handler="#lnWrapper1" required autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper2" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Email 1</label>
                                        <input class="form-control" type="text" value="{{$student->email1}}" name="email1" data-parsley-class-handler="#fnWrapper2" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper2" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Email 2</label>
                                        <input class="form-control" type="text" value="{{$student->email2}}" name="email2" data-parsley-class-handler="#lnWrapper2" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper3" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Street</label>
                                        <input class="form-control" type="text" name="street" value="{{$student->street}}" data-parsley-class-handler="#fnWrapper3" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper3" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Area</label>
                                        <input class="form-control" type="text" name="area" value="{{$student->area}}" data-parsley-class-handler="#lnWrapper3" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper4" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">City</label>
                                        <input class="form-control" type="text" name="city" value="{{$student->city}}" data-parsley-class-handler="#fnWrapper4" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper4" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Country</label>
                                        <input class="form-control" type="text" name="country" value="{{$student->country}}" data-parsley-class-handler="#lnWrapper4" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                  </div><!-- card -->                
                  <div class="card">
                    <div class="card-header" role="tab" id="headingTwo">
                      <h6 class="mg-b-0">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo" class="tx-gray-800 transition">
                          Emergency Contact
                        </a>
                      </h6>
                    </div><!-- card-header -->
                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                      <div class="card-block pd-20">
                          <div class="row mg-b-25 start_date">
                              <div class="col-lg-6">
                                <div id="fnWrapper5" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Name</label>
                                        <input class="form-control" type="text" value="{{$student->em_name}}" name="em_name" data-parsley-class-handler="#fnWrapper5" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper5" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Relation</label>
                                        <input class="form-control" type="text" value="{{$student->em_relation}}" name="em_relation" data-parsley-class-handler="#lnWrapper5" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper6" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Mobile</label>
                                        <input class="form-control" type="text" value="{{$student->em_mobile}}" name="em_mobile" data-parsley-class-handler="#fnWrapper6" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper6" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Email</label>
                                        <input class="form-control" type="text" value="{{$student->em_email}}" name="em_email" data-parsley-class-handler="#lnWrapper6" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div><!-- card -->
                  <div class="card">
                      <div class="card-header" role="tab" id="headingThree">
                        <h6 class="mg-b-0">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                          aria-expanded="true" aria-controls="collapseThree" class="tx-gray-800 transition">
                            Education
                          </a>
                        </h6>
                      </div><!-- card-header -->
                      <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="card-block pd-20">
                          <div class="row mg-b-25">
                            <div class="col-lg-6">
                                <div id="fnWrapper6" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Degree</label>
                                        <input class="form-control" type="text" value="{{$student->degree}}" name="degree" data-parsley-class-handler="#fnWrapper6" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper7" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Major</label>
                                        <input class="form-control" type="text" value="{{$student->major}}" name="major" data-parsley-class-handler="#lnWrapper7" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper8" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Faculty</label>
                                        <input class="form-control" type="text" value="{{$student->faculty}}" name="faculty" data-parsley-class-handler="#fnWrapper8" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper9" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">University</label>
                                        <input class="form-control" type="text" value="{{$student->university}}" name="university" data-parsley-class-handler="#lnWrapper9" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper10" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Grade/GPA</label>
                                        <input class="form-control" type="text" value="{{$student->grade}}" name="grade" data-parsley-class-handler="#lnWrapper10" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper11" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Date Obtained</label>
                                        <input class="form-control  datepicker dpd" value="{{$student->date}}" data-date-format="dd-mm-yyyy" type="text" name="date" data-parsley-class-handler="#lnWrapper11" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                  </div><!-- card -->
                  <div class="card">
                      <div class="card-header" role="tab" id="headingFour">
                        <h6 class="mg-b-0">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"
                          aria-expanded="true" aria-controls="collapseFour" class="tx-gray-800 transition">
                            Student Finance Data
                          </a>
                        </h6>
                      </div><!-- card-header -->
                      <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour">
                        <div class="card-block pd-20">
                          <div class="row mg-b-25">
                            <div class="col-lg-6">
                                <div id="lnWrapper12" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Balance</label>
                                        <input class="form-control" type="text" value="{{$student->balance}}" name="balance" data-parsley-class-handler="#lnWrapper12" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div id="lnWrapper66" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Application Fees</label>
                                        <input class="form-control" type="text" value="{{$student->application_fees}}" name="application_fees" data-parsley-class-handler="#lnWrapper66" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div id="fnWrapper66" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Discount Rate</label>
                                        <input class="form-control" type="text" value="{{$student->discount_rate}}" name="discount_rate" data-parsley-class-handler="#fnWrapper66" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div id="lnWrapper77" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Total in EGP</label>
                                        <input class="form-control" type="text" value="{{$student->total_egp}}" name="total_egp" data-parsley-class-handler="#lnWrapper77" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div id="fnWrapper77" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Total in USD</label>
                                        <input class="form-control" type="text" value="{{$student->total_usd}}" name="total_usd" data-parsley-class-handler="#fnWrapper77" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div id="fnWrapper78" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Total in Euro</label>
                                        <input class="form-control" type="text" value="{{$student->total_euro}}" name="total_euro" data-parsley-class-handler="#fnWrapper78" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div id="lnWrapper88" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Notes</label>
                                        <textarea class="form-control" name="notes" data-parsley-class-handler="#lnWrapper88" autocomplete="off">{{$student->notes}}</textarea>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div><!-- card -->
                  <div class="card">
                      <div class="card-header" role="tab" id="headingFive">
                        <h6 class="mg-b-0">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive"
                          aria-expanded="true" aria-controls="collapseFive" class="tx-gray-800 transition">
                            Employment Details
                          </a>
                        </h6>
                      </div><!-- card-header -->
                      <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive">
                        <div class="card-block pd-20">
                            <div class="row mg-b-25">
                              <div class="col-lg-6">
                                <h4>Current Employer Information</h4>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                  <a class="btn btn-outline-primary" id="show_corporate"><i class="fa fa-plus"></i> Add New Corporate</a>
                                </div>
                              </div>
                              <div class="col-lg-6" id="corporate_text" style="display:none;">
                                <div id="lnWrapper81" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Corporate Name</label>
                                        <input class="form-control" type="text" id="corp_name" name="corp_name" data-parsley-class-handler="#lnWrapper81" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6" id="corporate_button" style="display:none;">
                                <a id="submit_corporate" class="btn btn-primary">Add</a>
                              </div>
                              <div class="col-lg-6">
                                <div class="d-flex">
                                  <div id="slWrapper2" class="parsley-select" style="width:100%">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Corporate</label>
                                        <select id="corp1" class="form-control pmd-select2 select2-show-search" name="corporate_id" data-parsley-class-handler="#slWrapper2"
                                          data-parsley-errors-container="#slErrorContainer2" style="width:100%">
                                          <option></option>
                                          @foreach($corporates as $corporate)
                                            <option value="{{$corporate->id}}" @if($corporate->id == $student->corporate_id) selected @endif>{{$corporate->name}}</option>
                                          @endforeach
                                        </select>
                                        <div id="slErrorContainer2"></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper13" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Position</label>
                                        <input class="form-control" type="text" value="{{$student->job}}" name="job" data-parsley-class-handler="#lnWrapper13" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              </div>
                              <div class="row mg-b-25 corporate">
                                <div class="col-lg-6">
                                  <h4>Previous Work Information</h4>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <input type="hidden" class="form-control" name="num3" id="num3"  value="1"/>
                                    <a class="btn btn-outline-primary add_form_field3"><i class="fa fa-plus"></i> Add</a>
                                  </div>
                                </div>
                                <div class="col-lg-6" id="remove_corporate1">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <label class="control-label">Corporate</label>
                                    <select id="corp2" class="form-control pmd-select2 select2-show-search" name="corporates[{{$key}}][corporate_id]" style="width:100%">
                                      <option></option>
                                      @foreach($corporates as $corporate)
                                        <option value="{{$corporate->id}}">{{$corporate->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="col-lg-6" id="remove_corporate2">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                      <label class="control-label">Position</label>
                                      <input class="form-control" type="text" name="corporates[{{$key}}][position]">
                                  </div>
                                </div>
                                <div class="col-lg-6" id="remove_corporate3">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <label class="control-label">Date From</label>
                                      <input class="form-control datepicker dpd" data-date-format="dd-mm-yyyy" type="text" name="corporates[{{$key}}][from]">
                                  </div>
                                </div>
                                <div class="col-lg-6" id="remove_corporate4">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <label class="control-label">Date To</label>
                                    <input class="form-control datepicker dpd" data-date-format="dd-mm-yyyy" type="text" name="corporates[{{$key}}][to]">
                                  </div>
                                </div>
                                <div id="old_remove_corporate_button" class="col-lg-6">
                                </div>
                                <div class="col-lg-12">
                                  <div class="bd bd-gray-300 rounded table-responsive">
                                    <table class="table mg-b-0">
                                      <thead>
                                        <tr>
                                          <th>Corporate Name</th>
                                          <th>Date From</th>
                                          <th>Date To</th>
                                          <th>Position</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($student->studentCorporates as $corporate)
                                        <tr>
                                          <th>{{$corporate->name}}</th>
                                          <th>{{$corporate->pivot->from}}</th>
                                          <th>{{$corporate->pivot->to}}</th>
                                          <th>{{$corporate->pivot->position}}</th>
                                        </tr>
                                      @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                        </div>
                      </div>
                  </div><!-- card -->
                  <div class="card">
                      <div class="card-header" role="tab" id="headingSix">
                        <h6 class="mg-b-0">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix"
                          aria-expanded="true" aria-controls="collapseSix" class="tx-gray-800 transition">
                            Select Student Service
                          </a>
                        </h6>
                      </div><!-- card-header -->
                      <div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingSix">
                        <div class="card-block pd-20">
                          <div class="row mg-b-25">
                            <div class="col-lg-2">
                              <label class="control-label">Choose Service: </label>
                            </div><!-- col-3 -->
                            <div class="col-lg-2">
                              <label class="rdiobox">
                                <input name="service" type="radio" id="program" value="Program" @if($student->service == "Program") checked @endif>
                                <span>Program</span>
                              </label>
                            </div><!-- col-3 -->
                            <div class="col-lg-2">
                              <label class="rdiobox">
                                <input name="service" type="radio" id="diplom" value="Diploma" @if($student->service == "Diploma") checked @endif>
                                <span>Diploma</span>
                              </label>
                            </div><!-- col-3 -->
                            <div class="col-lg-2">
                              <label class="rdiobox">
                                <input name="service" type="radio" id="training" value="Training" @if($student->service == "Training") checked @endif>
                                <span>Training</span>
                              </label>
                            </div><!-- col-3 -->
                            <div class="col-lg-2">
                              <label class="rdiobox">
                                <input name="service" type="radio" id="consulting" value="Consulting" @if($student->service == "Consulting") checked @endif>
                                <span>Consulting</span>
                              </label>
                            </div><!-- col-3 -->
                            <br>
                            <div class="col-lg-4">
                              <div class="d-flex">
                                <div id="slWrapper1" class="parsley-select" style="width:100%">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                                    <label class="control-label">Program</label>
                                    <select id="program_list" onchange="programFunction()" class="form-control pmd-select2 select2-show-search" name="program_id" data-parsley-class-handler="#slWrapper1"
                                        data-parsley-errors-container="#slErrorContainer1" style="width:100%">
                                      @foreach($programs as $program)
                                        <option value="{{$program->id}}" @if($program->id == $student->program_id) selected @endif>{{$program->name}}</option>
                                      @endforeach
                                    </select>
                                    <div id="slErrorContainer1"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="d-flex">
                                <div id="slWrapper2" class="parsley-select" style="width:100%">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                                    <label class="control-label">Diploma</label>
                                    <select id="diplom_list" onchange="diplomFunction()" class="form-control pmd-select2 select2-show-search" name="diplom_id" data-parsley-class-handler="#slWrapper2"
                                        data-parsley-errors-container="#slErrorContainer2" style="width:100%">
                                      <option></option>
                                      @foreach($diploms as $diplom)
                                        <option value="{{$diplom->id}}" @if($diplom->id == $student->diplom_id) selected @endif>{{$diplom->name}}</option>
                                      @endforeach
                                    </select>
                                    <div id="slErrorContainer2"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="d-flex">
                                <div id="slWrapper3" class="parsley-select" style="width:100%">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                                    <label class="control-label">Training</label>
                                    <select id="training_list" class="form-control pmd-select2 select2-show-search" name="training_course_id" data-parsley-class-handler="#slWrapper3"
                                        data-parsley-errors-container="#slErrorContainer3" style="width:100%">
                                      <option></option>
                                      @foreach($courses as $course)
                                        <option value="{{$course->id}}" @if($course->id == $student->training_course_id) selected @endif>{{$course->name}}</option>
                                      @endforeach
                                    </select>
                                    <div id="slErrorContainer3"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @if($student->program_id != null)
                            <div class="col-lg-6" id="program_intakes">
                              <div class="d-flex">
                                <div id="slWrapper4" class="parsley-select" style="width:100%">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                                    <label class="control-label">Program Intake</label>
                                    <select id="program_intake" class="form-control pmd-select2 select2-show-search" name="program_intake_id" data-parsley-class-handler="#slWrapper4"
                                        data-parsley-errors-container="#slErrorContainer4" style="width:100%">
                                      <option></option>
                                      @foreach($program_intakes as $intake)
                                        <option value="{{$intake->id}}" @if($intake->id == $student->program_intake_id) selected @endif>{{$intake->name}}</option>
                                      @endforeach
                                    </select>
                                    <div id="slErrorContainer4"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6" id="program_courses">
                              <div class="d-flex">
                                <div id="slWrapper5" class="parsley-select" style="width:100%">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                                    <label class="control-label">Program Course</label>
                                    <select id="program_course" class="form-control pmd-select2 select2-show-search" name="program_course_id" data-parsley-class-handler="#slWrapper5"
                                        data-parsley-errors-container="#slErrorContainer5" style="width:100%">
                                      <option></option>
                                      @foreach($program_courses as $course)
                                        <option value="{{$course->id}}" @if($course->id == $student->program_course_id) selected @endif>{{$course->name}}</option>
                                      @endforeach
                                    </select>
                                    <div id="slErrorContainer5"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @endif
                            @if($student->diplom_id != null)
                            <div class="col-lg-6" id="diplom_intakes">
                              <div class="d-flex">
                                <div id="slWrapper6" class="parsley-select" style="width:100%">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                                    <label class="control-label">Diplom Intake</label>
                                    <select id="diplom_intake" class="form-control pmd-select2 select2-show-search" name="diplom_intake_id" data-parsley-class-handler="#slWrapper6"
                                        data-parsley-errors-container="#slErrorContainer6" style="width:100%">
                                      <option></option>
                                      @foreach($diplom_intakes as $intake)
                                        <option value="{{$intake->id}}" @if($intake->id == $student->diplom_intake_id) selected @endif>{{$intake->name}}</option>
                                      @endforeach
                                    </select>
                                    <div id="slErrorContainer6"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6" id="diplom_courses">
                              <div class="d-flex">
                                <div id="slWrapper7" class="parsley-select" style="width:100%">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                                    <label class="control-label">Diplom Course</label>
                                    <select id="diplom_course" class="form-control pmd-select2 select2-show-search" name="diplom_course_id" data-parsley-class-handler="#slWrapper7"
                                        data-parsley-errors-container="#slErrorContainer7" style="width:100%">
                                      <option></option>
                                      @foreach($diplom_courses as $course)
                                        <option value="{{$course->id}}" @if($course->id == $student->diplom_course_id) selected @endif>{{$course->name}}</option>
                                      @endforeach
                                    </select>
                                    <div id="slErrorContainer7"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @endif
                            <div class="col-lg-12">
                                <div id="fnWrapper99" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Notes</label>
                                        <input class="form-control" type="text" name="service_note" value="{{$student->service_note}}" data-parsley-class-handler="#fnWrapper99" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div><!-- card -->
                  <div class="card">
                    <div class="card-header" role="tab" id="headingSeven">
                      <h6 class="mg-b-0">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven"
                        aria-expanded="true" aria-controls="collapseSeven" class="tx-gray-800 transition">
                          Notes
                        </a>
                      </h6>
                    </div><!-- card-header -->
                    <div id="collapseSeven" class="collapse" role="tabpanel" aria-labelledby="headingSeven">
                      <div class="card-block pd-20">
                          <div class="row mg-b-25 price-form">
                            <div class="col-lg-6" id="remove_test3">
                                <div class="form-group">
                                  <label class="control-label">Description</label>
                                  <textarea rows="7" class="form-control" name="description">{{$student->description}}</textarea>
                                </div>
                              </div>
                              <div class="col-lg-6" id="remove_test4">
                                <div class="form-group">
                                  <label class="control-label">Group Admission</label>
                                    <textarea rows="7" class="form-control" name="group_admission">{{$student->group_admission}}</textarea>
                                </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div><!-- card -->
                  <!-- ADD MORE CARD HERE -->
                </div><!-- accordion -->
                <br>
                <div class="col-lg-12">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div><!-- col-12 -->
          </div><!-- row -->
        </div><!-- form-layout -->
      </div><!-- br-section-wrapper -->
    </div><!-- br-pagebody -->     
@endsection
@include('admin.pages.students.edit.scripts')