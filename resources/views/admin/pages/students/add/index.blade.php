@extends('admin.layouts.master')
@section('meta')
    <!-- meta tags -->
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
                                      <input type="file" id="imgInp" class="upload" name="image">
                                  </div>
                                  <img src="{{asset('vendors/img/1.jpg')}}" id="blah" class="img-circle" alt="">
                                  <p id="student_image">Student Image : (1000 x 1000)</p><hr>
                                </div>
                              </div><!-- col-12 -->
                              <div class="col-lg-6">
                                <div id="fnWrapper" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">First Name</label>
                                        <input class="form-control" type="text" name="name" data-parsley-class-handler="#fnWrapper" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Middle Name</label>
                                        <input class="form-control" type="text" name="middle_name" data-parsley-class-handler="#fnWrapper" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">LastName</label>
                                        <input class="form-control" type="text" name="last_name" data-parsley-class-handler="#lnWrapper" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="d-flex">
                                  <div id="slWrapper" class="parsley-select" style="width:100%">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Gender</label>
                                        <select class="form-control pmd-select2 select2-show-search" name="gender" data-parsley-class-handler="#slWrapper"
                                          data-parsley-errors-container="#slErrorContainer" style="width:100%">
                                          <option></option>
                                          <option value="Male">Male</option>
                                          <option value="Female">Female</option>
                                        </select>
                                        <div id="slErrorContainer"></div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div id="lnWrapper" class="parsley-input">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                          <label class="control-label">Location</label>
                                          <input class="form-control" type="text" name="location" data-parsley-class-handler="#lnWrapper" autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div id="lnWrapper55" class="parsley-input">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                          <label class="control-label">National ID</label>
                                          <input class="form-control" type="text" name="national_id" data-parsley-class-handler="#lnWrapper55" autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div id="fnWrapper1" class="parsley-input">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                          <label class="control-label">Mobile 1</label>
                                          <input class="form-control" type="text" name="mobile1" data-parsley-class-handler="#fnWrapper1" autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div id="lnWrapper1" class="parsley-input">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                          <label class="control-label">Mobile 2</label>
                                          <input class="form-control" type="text" name="mobile2" data-parsley-class-handler="#lnWrapper1" autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper2" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Email 1</label>
                                        <input class="form-control" type="text" name="email1" data-parsley-class-handler="#fnWrapper2" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper2" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Email 2</label>
                                        <input class="form-control" type="text" name="email2" data-parsley-class-handler="#lnWrapper2" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper3" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Street</label>
                                        <input class="form-control" type="text" name="street" data-parsley-class-handler="#fnWrapper3" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper3" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Area</label>
                                        <input class="form-control" type="text" name="area" data-parsley-class-handler="#lnWrapper3" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper4" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">City</label>
                                        <input class="form-control" type="text" name="city" data-parsley-class-handler="#fnWrapper4" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper4" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Country</label>
                                        <input class="form-control" type="text" name="country" data-parsley-class-handler="#lnWrapper4" autocomplete="off">
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
                                        <input class="form-control" type="text" name="em_name" data-parsley-class-handler="#fnWrapper5" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper5" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Relation</label>
                                        <input class="form-control" type="text" name="em_relation" data-parsley-class-handler="#lnWrapper5" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper6" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Mobile</label>
                                        <input class="form-control" type="text" name="em_mobile" data-parsley-class-handler="#fnWrapper6" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper6" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Email</label>
                                        <input class="form-control" type="text" name="em_email" data-parsley-class-handler="#lnWrapper6" autocomplete="off">
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
                                        <input class="form-control" type="text" name="degree" data-parsley-class-handler="#fnWrapper6" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper7" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Major</label>
                                        <input class="form-control" type="text" name="major" data-parsley-class-handler="#lnWrapper7" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper8" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Faculty</label>
                                        <input class="form-control" type="text" name="faculty" data-parsley-class-handler="#fnWrapper8" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper9" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">University</label>
                                        <input class="form-control" type="text" name="university" data-parsley-class-handler="#lnWrapper9" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper10" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Grade/GPA</label>
                                        <input class="form-control" type="text" name="grade" data-parsley-class-handler="#lnWrapper10" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper11" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Date Obtained</label>
                                        <input class="form-control  datepicker dpd" data-date-format="dd-mm-yyyy" type="text" name="date" data-parsley-class-handler="#lnWrapper11" autocomplete="off">
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
                                        <input class="form-control" type="text" name="balance" data-parsley-class-handler="#lnWrapper12" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div id="lnWrapper66" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Application Fees</label>
                                        <input class="form-control" type="text" name="application_fees" data-parsley-class-handler="#lnWrapper66" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div id="fnWrapper66" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Discount Rate</label>
                                        <input class="form-control" type="text" name="discount_rate" data-parsley-class-handler="#fnWrapper66" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div id="lnWrapper77" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Total in EGP</label>
                                        <input class="form-control" type="text" name="total_egp" data-parsley-class-handler="#lnWrapper77" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div id="fnWrapper77" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Total in USD</label>
                                        <input class="form-control" type="text" name="total_usd" data-parsley-class-handler="#fnWrapper77" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div id="fnWrapper78" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Total in Euro</label>
                                        <input class="form-control" type="text" name="total_euro" data-parsley-class-handler="#fnWrapper78" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div id="lnWrapper88" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Notes</label>
                                        <textarea class="form-control" name="notes" data-parsley-class-handler="#lnWrapper88" autocomplete="off"></textarea>
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
                                <div id="lnWrapper13" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Position</label>
                                        <input class="form-control" type="text" name="job" data-parsley-class-handler="#lnWrapper13" autocomplete="off">
                                    </div>
                                </div>
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
                                            <option value="{{$corporate->id}}">{{$corporate->name}}</option>
                                          @endforeach
                                        </select>
                                        <div id="slErrorContainer2"></div>
                                    </div>
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
                                <input name="service" onclick="ShowHideDiv()" type="radio" id="program" value="Program">
                                <span>Program</span>
                              </label>
                            </div><!-- col-3 -->
                            <div class="col-lg-2">
                              <label class="rdiobox">
                                <input name="service" onclick="ShowHideDiv()" type="radio" id="diplom" value="Diploma">
                                <span>Diploma</span>
                              </label>
                            </div><!-- col-3 -->
                            <div class="col-lg-2">
                              <label class="rdiobox">
                                <input name="service" onclick="ShowHideDiv()" type="radio" id="training" value="Training">
                                <span>Training</span>
                              </label>
                            </div><!-- col-3 -->
                            <div class="col-lg-2">
                              <label class="rdiobox">
                                <input name="service" onclick="ShowHideDiv()" type="radio" id="consulting" value="Consulting">
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
                                        data-parsley-errors-container="#slErrorContainer1" style="width:100%" disabled>
                                      <option></option>
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
                                        data-parsley-errors-container="#slErrorContainer2" style="width:100%" disabled>
                                      <option></option>
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
                                        data-parsley-errors-container="#slErrorContainer3" style="width:100%" disabled>
                                      <option></option>
                                    </select>
                                    <div id="slErrorContainer3"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6" style="display:none;" id="program_intakes">
                              <div class="d-flex">
                                <div id="slWrapper4" class="parsley-select" style="width:100%">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                                    <label class="control-label">Program Intake</label>
                                    <select id="program_intake" class="form-control pmd-select2 select2-show-search" name="program_intake_id" data-parsley-class-handler="#slWrapper4"
                                        data-parsley-errors-container="#slErrorContainer4" style="width:100%" disabled>
                                      <option></option>
                                    </select>
                                    <div id="slErrorContainer4"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6" style="display:none;" id="program_courses">
                              <div class="d-flex">
                                <div id="slWrapper5" class="parsley-select" style="width:100%">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                                    <label class="control-label">Program Course</label>
                                    <select id="program_course" class="form-control pmd-select2 select2-show-search" name="program_course_id" data-parsley-class-handler="#slWrapper5"
                                        data-parsley-errors-container="#slErrorContainer5" style="width:100%" disabled>
                                      <option></option>
                                    </select>
                                    <div id="slErrorContainer5"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6" style="display:none;" id="diplom_intakes">
                              <div class="d-flex">
                                <div id="slWrapper6" class="parsley-select" style="width:100%">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                                    <label class="control-label">Diplom Intake</label>
                                    <select id="diplom_intake" class="form-control pmd-select2 select2-show-search" name="diplom_intake_id" data-parsley-class-handler="#slWrapper6"
                                        data-parsley-errors-container="#slErrorContainer6" style="width:100%" disabled>
                                      <option></option>
                                    </select>
                                    <div id="slErrorContainer6"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6" style="display:none;" id="diplom_courses">
                              <div class="d-flex">
                                <div id="slWrapper7" class="parsley-select" style="width:100%">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                                    <label class="control-label">Diplom Course</label>
                                    <select id="diplom_course" class="form-control pmd-select2 select2-show-search" name="diplom_course_id" data-parsley-class-handler="#slWrapper7"
                                        data-parsley-errors-container="#slErrorContainer7" style="width:100%" disabled>
                                      <option></option>
                                    </select>
                                    <div id="slErrorContainer7"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-12">
                                <div id="fnWrapper99" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Notes</label>
                                        <input class="form-control" type="text" name="service_note" data-parsley-class-handler="#fnWrapper99" autocomplete="off">
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
                                  <textarea rows="7" class="form-control" name="description"></textarea>
                                </div>
                              </div>
                              <div class="col-lg-6" id="remove_test4">
                                <div class="form-group">
                                  <label class="control-label">Group Admission</label>
                                    <textarea rows="7" class="form-control" name="group_admission"></textarea>
                                </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div><!-- card -->
                  <!-- ADD MORE CARD HERE -->
                </div><!-- accordion -->
                <br>
                <div class="col-lg-12" id="submit-div">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div><!-- col-12 -->
          </div><!-- row -->
        </div><!-- form-layout -->
      </div><!-- br-section-wrapper -->
    </div><!-- br-pagebody -->     
@endsection
@include('admin.pages.students.add.scripts')