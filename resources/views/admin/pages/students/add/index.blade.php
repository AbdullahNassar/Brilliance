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
              <form class="parsley-style-1" id="document_form" method="post" enctype="multipart/form-data" data-parsley-validate>
                {{csrf_field()}}
                <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
                  <div class="card">
                      <div class="card-header" role="tab" id="headingEight">
                        <h6 class="mg-b-0">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseEight"
                          aria-expanded="true" aria-controls="collapseEight" class="tx-gray-800 transition">
                          Upload Student Documents
                          </a>
                        </h6>
                      </div><!-- card-header -->
                      <div id="collapseEight" class="collapse" role="tabpanel" aria-labelledby="headingEight">
                        <div class="card-block pd-20">
                            <div class="row mg-b-25 align-items-center">
                              <div class="col-lg-6">
                                <div class="form-group custom-inputfile" style="margin-left: 10px !important;">
                                  <input type="file" name="statement" id="file-6" class="inputfile inputfile-6">
                                  <label for="file-6"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg>Choose File&hellip;</strong></label>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="d-flex">
                                  <div id="slWrapper" class="parsley-select" style="width: 100%; margin-bottom: 10px !important;">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Document Type</label>
                                        <select class="form-control pmd-select2 select2-show-search" name="document_id" data-parsley-class-handler="#slWrapper"
                                          data-parsley-errors-container="#slErrorContainer" style="width: 100%;" required>
                                          <option></option>
                                          <option value="Male">Male</option>
                                          <option value="Female">Female</option>
                                        </select>
                                        <div id="slErrorContainer"></div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary center">Save</button>
                              </div>
                            </div>
                        </div>
                    </div>
                  </div><!-- card -->                
                  <!-- ADD MORE CARD HERE -->
                </div><!-- accordion -->
              </form>
            </div><!-- col-12 -->
          </div><!-- row -->
          <div class="row mg-b-25">
            <div class="col-lg-12">
              <form class="parsley-style-1" id="program_form" method="post" enctype="multipart/form-data" data-parsley-validate>
                {{csrf_field()}}
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
                                        <input class="form-control" type="text" name="name" data-parsley-class-handler="#fnWrapper" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Middle Name</label>
                                        <input class="form-control" type="text" name="name" data-parsley-class-handler="#fnWrapper" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">LastName</label>
                                        <input class="form-control" type="text" name="name" data-parsley-class-handler="#fnWrapper" required autocomplete="off">
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
                                          <option></option>
                                          <option value="Male">Male</option>
                                          <option value="Female">Female</option>
                                        </select>
                                        <div id="slErrorContainer"></div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-lg-12">
                                  <div id="lnWrapper" class="parsley-input">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                          <label class="control-label">Location</label>
                                          <input class="form-control" type="text" name="location" data-parsley-class-handler="#lnWrapper" required autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div id="fnWrapper1" class="parsley-input">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                          <label class="control-label">Mobile 1</label>
                                          <input class="form-control" type="text" name="mobile1" data-parsley-class-handler="#fnWrapper1" required autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div id="lnWrapper1" class="parsley-input">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                          <label class="control-label">Mobile 2</label>
                                          <input class="form-control" type="text" name="mobile2" data-parsley-class-handler="#lnWrapper1" required autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper2" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Email 1</label>
                                        <input class="form-control" type="text" name="email1" data-parsley-class-handler="#fnWrapper2" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper2" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Email 2</label>
                                        <input class="form-control" type="text" name="email2" data-parsley-class-handler="#lnWrapper2" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper3" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Street</label>
                                        <input class="form-control" type="text" name="street" data-parsley-class-handler="#fnWrapper3" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper3" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Area</label>
                                        <input class="form-control" type="text" name="area" data-parsley-class-handler="#lnWrapper3" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper4" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">City</label>
                                        <input class="form-control" type="text" name="city" data-parsley-class-handler="#fnWrapper4" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper4" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Country</label>
                                        <input class="form-control" type="text" name="country" data-parsley-class-handler="#lnWrapper4" required autocomplete="off">
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
                                        <input class="form-control" type="text" name="em_name" data-parsley-class-handler="#fnWrapper5" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper5" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Relation</label>
                                        <input class="form-control" type="text" name="em_relation" data-parsley-class-handler="#lnWrapper5" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper6" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Mobile</label>
                                        <input class="form-control" type="text" name="em_mobile" data-parsley-class-handler="#fnWrapper6" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper6" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Email</label>
                                        <input class="form-control" type="text" name="em_email" data-parsley-class-handler="#lnWrapper6" required autocomplete="off">
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
                                        <input class="form-control" type="text" name="degree" data-parsley-class-handler="#fnWrapper6" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper7" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Major</label>
                                        <input class="form-control" type="text" name="major" data-parsley-class-handler="#lnWrapper7" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper8" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Faculty</label>
                                        <input class="form-control" type="text" name="faculty" data-parsley-class-handler="#fnWrapper8" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper9" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">University</label>
                                        <input class="form-control" type="text" name="university" data-parsley-class-handler="#lnWrapper9" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper10" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Grade/GPA</label>
                                        <input class="form-control" type="text" name="university" data-parsley-class-handler="#lnWrapper10" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper11" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Date Obtained</label>
                                        <input class="form-control  datepicker dpd" data-date-format="dd-mm-yyyy" type="text" name="date" data-parsley-class-handler="#lnWrapper11" required autocomplete="off">
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
                            Student E-Wallet
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
                                        <input class="form-control" type="text" name="balance" data-parsley-class-handler="#lnWrapper12" required autocomplete="off">
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
                            Current Employment Details
                          </a>
                        </h6>
                      </div><!-- card-header -->
                      <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive">
                        <div class="card-block pd-20">
                            <div class="row mg-b-25 language">
                              <div class="col-lg-12">
                                <h4>Employer Information</h4>
                              </div>
                              <div class="col-lg-12">
                                  <div class="user-img-upload">
                                      <div class="fileUpload user-editimg">
                                          <span><i class="fa fa-camera"></i> Upload</span>
                                          <input type="file" id="imgInp2" class="upload" name="cover">
                                      </div>
                                      <img src="{{asset('vendors/img/1.jpg')}}" id="blah2" class="img-circle" alt="">
                                      <p>Employer Logo</p>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper13" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Position</label>
                                        <input class="form-control" type="text" name="position" data-parsley-class-handler="#lnWrapper13" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper13" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Department</label>
                                        <input class="form-control" type="text" name="department" data-parsley-class-handler="#fnWrapper13" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper14" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Business Unit</label>
                                        <input class="form-control" type="text" name="position" data-parsley-class-handler="#lnWrapper14" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper14" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Location</label>
                                        <input class="form-control" type="text" name="location" data-parsley-class-handler="#fnWrapper14" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper15" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Employer</label>
                                        <input class="form-control" type="text" name="employer" data-parsley-class-handler="#lnWrapper15" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper15" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Industry</label>
                                        <input class="form-control" type="text" name="industry" data-parsley-class-handler="#fnWrapper15" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper16" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Head Count</label>
                                        <input class="form-control" type="text" name="head_count" data-parsley-class-handler="#lnWrapper16" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper16" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Type</label>
                                        <input class="form-control" type="text" name="type" data-parsley-class-handler="#fnWrapper16" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <h4>Work Information</h4>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper17" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Street</label>
                                        <input class="form-control" type="text" name="co_street" data-parsley-class-handler="#lnWrapper17" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper17" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Area</label>
                                        <input class="form-control" type="text" name="co_area" data-parsley-class-handler="#fnWrapper17" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper18" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">City</label>
                                        <input class="form-control" type="text" name="co_city" data-parsley-class-handler="#lnWrapper18" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper18" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Landmark</label>
                                        <input class="form-control" type="text" name="co_landmark" data-parsley-class-handler="#fnWrapper18" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper19" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Country</label>
                                        <input class="form-control" type="text" name="co_country" data-parsley-class-handler="#lnWrapper19" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper19" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Website</label>
                                        <input class="form-control" type="text" name="co_website" data-parsley-class-handler="#fnWrapper19" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper20" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Email</label>
                                        <input class="form-control" type="email" name="co_email" data-parsley-class-handler="#lnWrapper20" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper20" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Mobile</label>
                                        <input class="form-control" type="text" name="co_mobile" data-parsley-class-handler="#fnWrapper20" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper21" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Fax</label>
                                        <input class="form-control" type="text" name="co_fax" data-parsley-class-handler="#lnWrapper21" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <h4>Head Office Information</h4>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper22" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Street</label>
                                        <input class="form-control" type="text" name="co_street" data-parsley-class-handler="#lnWrapper22" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper22" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Area</label>
                                        <input class="form-control" type="text" name="co_area" data-parsley-class-handler="#fnWrapper22" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper23" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">City</label>
                                        <input class="form-control" type="text" name="co_city" data-parsley-class-handler="#lnWrapper23" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper23" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Landmark</label>
                                        <input class="form-control" type="text" name="co_landmark" data-parsley-class-handler="#fnWrapper23" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper24" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Country</label>
                                        <input class="form-control" type="text" name="co_country" data-parsley-class-handler="#lnWrapper24" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper24" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Website</label>
                                        <input class="form-control" type="text" name="co_website" data-parsley-class-handler="#fnWrapper24" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper25" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Email</label>
                                        <input class="form-control" type="email" name="co_email" data-parsley-class-handler="#lnWrapper25" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper25" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Mobile</label>
                                        <input class="form-control" type="text" name="co_mobile" data-parsley-class-handler="#fnWrapper25" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper26" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Fax</label>
                                        <input class="form-control" type="text" name="co_fax" data-parsley-class-handler="#lnWrapper26" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="row mg-b-25 contact">
                                <div class="col-lg-6">
                                  <h4>Corporate Contacts</h4>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <input type="hidden" class="form-control" name="num3" id="num3"  value="1"/>
                                    <a class="btn btn-outline-primary add_form_field3"><i class="fa fa-plus"></i> Add</a>
                                  </div>
                                </div>
                                <div class="col-lg-6" id="remove_contact1">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                      <label class="control-label">Name</label>
                                      <input class="form-control" type="text" name="contacts[{{$key}}][name]">
                                  </div>
                                </div>
                                <div class="col-lg-6" id="remove_contact2">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Position</label>
                                        <input class="form-control" type="text" name="contacts[{{$key}}][position]">
                                    </div>
                                </div>
                                <div class="col-lg-6" id="remove_contact3">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                      <label class="control-label">Email</label>
                                      <input class="form-control" type="text" name="contacts[{{$key}}][email]">
                                  </div>
                                </div>
                                <div class="col-lg-6" id="remove_contact4">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Mobile</label>
                                        <input class="form-control" type="text" name="contacts[{{$key}}][mobile]">
                                    </div>
                                </div>
                                <div id="old_remove_contact_button" class="col-lg-6">
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
                            Student Schedule
                          </a>
                        </h6>
                      </div><!-- card-header -->
                      <div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingSix">
                        <div class="card-block pd-20">
                          <div class="row mg-b-25">
                            <div class="col-lg-6">
                                <div id="lnWrapper27" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Date</label>
                                        <input class="form-control  datepicker dpd" data-date-format="dd-mm-yyyy" type="text" name="date" data-parsley-class-handler="#lnWrapper27" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                <label class="control-label">Time</label>
                                <input id="tpBasic" type="text" class="form-control">
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
                                  <textarea rows="7" class="form-control summernote" name="description"></textarea>
                                </div>
                              </div>
                              <div class="col-lg-6" id="remove_test4">
                                <div class="form-group">
                                  <label class="control-label">Group Admission</label>
                                    <textarea rows="7" class="form-control summernote" name="group_admission"></textarea>
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