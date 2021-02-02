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
@section('title','Employees')
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
        <a class="breadcrumb-item" href="{{route('admin.employees')}}">Employees</a>
        <span class="breadcrumb-item active">Edit Employee</span>
      </nav>
    </div><!-- br-pageheader -->
    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5">Employee Form</h4>
      <p class="mg-b-0">Forms are used to collect user information with different element types of input, select, checkboxes, radios and more.</p>
    </div>
    <div class="br-pagebody">
      <div class="br-section-wrapper">
        <div class="form-layout form-layout-1">
          <div class="row mg-b-25">
            <div class="col-lg-12">
              <form class="parsley-style-1" id="employee_form" method="post" enctype="multipart/form-data" data-parsley-validate>
                {{csrf_field()}}
                <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
                  <div class="card">
                      <div class="card-header" role="tab" id="headingOne">
                        <h6 class="mg-b-0">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                          aria-expanded="true" aria-controls="collapseOne" class="tx-gray-800 transition">
                          Employee Information
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
                                      <input type="file" id="imgInp" class="upload" name="image" value="{{$employee->image}}">
                                  </div>
                                  @if($employee->image != null)
                                  <img src="{{asset('images/users/'.$employee->image)}}" id="blah" class="img-circle" alt="">
                                  @else
                                  <img src="{{asset('vendors/img/1.jpg')}}" id="blah" class="img-circle" alt="">
                                  @endif
                                  <p id="employee_image">Employee Image : (1000 x 1000)</p><hr>
                                </div>
                              </div><!-- col-12 -->
                              <div class="col-lg-6">
                                <div id="fnWrapper" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">First Name</label>
                                        <input type="hidden" value="{{$employee->id}}" name="id">
                                        <input class="form-control" value="{{$employee->name}}" type="text" name="name" data-parsley-class-handler="#fnWrapper" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Middle Name</label>
                                        <input class="form-control" value="{{$employee->middle_name}}" type="text" name="middle_name" data-parsley-class-handler="#fnWrapper" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Last Name</label>
                                        <input class="form-control" value="{{$employee->last_name}}" type="text" name="last_name" data-parsley-class-handler="#fnWrapper" required autocomplete="off">
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
                                          <option value="Male" @if($employee->gender == "Male") selected @endif>Male</option>
                                          <option value="Female" @if($employee->gender == "Female") selected @endif>Female</option>
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
                                          <input class="form-control" value="{{$employee->location}}" type="text" name="locations" data-parsley-class-handler="#fnWrapper44" autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div id="lnWrapper33" class="parsley-input">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                          <label class="control-label">National ID</label>
                                          <input class="form-control" value="{{$employee->national_id}}" type="text" name="national_id" data-parsley-class-handler="#lnWrapper33" required autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div id="fnWrapper1" class="parsley-input">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                          <label class="control-label">Mobile 1</label>
                                          <input class="form-control" value="{{$employee->mobile1}}" type="text" name="mobile1" data-parsley-class-handler="#fnWrapper1" required autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div id="lnWrapper1" class="parsley-input">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                          <label class="control-label">Mobile 2</label>
                                          <input class="form-control" type="text" value="{{$employee->mobile2}}" name="mobile2" data-parsley-class-handler="#lnWrapper1" required autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper2" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Email 1</label>
                                        <input class="form-control" type="text" value="{{$employee->email1}}" name="email1" data-parsley-class-handler="#fnWrapper2" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper2" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Email 2</label>
                                        <input class="form-control" type="text" value="{{$employee->email2}}" name="email2" data-parsley-class-handler="#lnWrapper2" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper3" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Street</label>
                                        <input class="form-control" type="text" name="street" value="{{$employee->street}}" data-parsley-class-handler="#fnWrapper3" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper3" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Area</label>
                                        <input class="form-control" type="text" name="area" value="{{$employee->area}}" data-parsley-class-handler="#lnWrapper3" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper4" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">City</label>
                                        <input class="form-control" type="text" name="city" value="{{$employee->city}}" data-parsley-class-handler="#fnWrapper4" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper4" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Country</label>
                                        <input class="form-control" type="text" name="country" value="{{$employee->country}}" data-parsley-class-handler="#lnWrapper4" required autocomplete="off">
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
                            Education
                          </a>
                        </h6>
                      </div><!-- card-header -->
                      <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="card-block pd-20">
                          <div class="row mg-b-25">
                            <div class="col-lg-6">
                                <div id="fnWrapper6" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Degree</label>
                                        <input class="form-control" type="text" value="{{$employee->degree}}" name="degree" data-parsley-class-handler="#fnWrapper6" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper7" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Major</label>
                                        <input class="form-control" type="text" value="{{$employee->major}}" name="major" data-parsley-class-handler="#lnWrapper7" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper8" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Faculty</label>
                                        <input class="form-control" type="text" value="{{$employee->faculty}}" name="faculty" data-parsley-class-handler="#fnWrapper8" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper9" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">University</label>
                                        <input class="form-control" type="text" value="{{$employee->university}}" name="university" data-parsley-class-handler="#lnWrapper9" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper10" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Grade/GPA</label>
                                        <input class="form-control" type="text" value="{{$employee->grade}}" name="grade" data-parsley-class-handler="#lnWrapper10" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper11" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Date Obtained</label>
                                        <input class="form-control  datepicker dpd" value="{{$employee->date}}" data-date-format="dd-mm-yyyy" type="text" name="date" data-parsley-class-handler="#lnWrapper11" autocomplete="off">
                                    </div>
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
@include('admin.pages.employees.edit.scripts')