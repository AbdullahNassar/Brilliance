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
@section('title','Doctors')
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
        <a class="breadcrumb-item" href="{{route('admin.doctors')}}">Doctors</a>
        <span class="breadcrumb-item active">Add Doctor</span>
      </nav>
    </div><!-- br-pageheader -->
    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5">Doctor Form</h4>
      <p class="mg-b-0">Forms are used to collect user information with different element types of input, select, checkboxes, radios and more.</p>
    </div>
    <div class="br-pagebody">
      <div class="br-section-wrapper">
        <div class="form-layout form-layout-1">
          <div class="row mg-b-25">
            <div class="col-lg-12">
              <form class="parsley-style-1" id="doctor_form" method="post" enctype="multipart/form-data" data-parsley-validate>
                {{csrf_field()}}
                <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
                  <div class="card">
                      <div class="card-header" role="tab" id="headingOne">
                        <h6 class="mg-b-0">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                          aria-expanded="true" aria-controls="collapseOne" class="tx-gray-800 transition">
                          Doctor Information
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
                                      <input type="file" id="imgInp" class="upload" name="image" value="{{$doctor->image}}">
                                  </div>
                                  @if($doctor->image != null)
                                  <img src="{{asset('images/users/'.$doctor->image)}}" id="blah" class="img-circle" alt="">
                                  @else
                                  <img src="{{asset('vendors/img/1.jpg')}}" id="blah" class="img-circle" alt="">
                                  @endif
                                  <p id="doctor_image">Doctor Image : (1000 x 1000)</p><hr>
                                </div>
                              </div><!-- col-12 -->
                              <div class="col-lg-6">
                                <div id="fnWrapper" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Name</label>
                                        <input type="hidden" value="{{$doctor->id}}" name="id">
                                        <input class="form-control" value="{{$doctor->name}}" type="text" name="name" data-parsley-class-handler="#fnWrapper" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div id="lnWrapper33" class="parsley-input">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                          <label class="control-label">National ID</label>
                                          <input class="form-control" value="{{$doctor->national_id}}" type="text" name="national_id" data-parsley-class-handler="#lnWrapper33" required autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div id="fnWrapper1" class="parsley-input">
                                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                          <label class="control-label">Mobile</label>
                                          <input class="form-control" value="{{$doctor->mobile}}" type="text" name="mobile" data-parsley-class-handler="#fnWrapper1" required autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper2" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Email</label>
                                        <input class="form-control" type="text" value="{{$doctor->email}}" name="email" data-parsley-class-handler="#fnWrapper2" required autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="form-group custom-inputfile" style="margin-left: 10px !important;">
                                      <input type="file" name="cv" id="file-6" class="inputfile inputfile-6"  value="{{$doctor->cv}}">
                                      <label for="file-6"><span>{{$doctor->cv}}</span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg>Upload CV&hellip;</strong></label>
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
                          Education Information
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
                                        <input class="form-control" type="text" value="{{$doctor->degree}}" name="degree" data-parsley-class-handler="#fnWrapper6" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper7" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Major</label>
                                        <input class="form-control" type="text" value="{{$doctor->major}}" name="major" data-parsley-class-handler="#lnWrapper7" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="fnWrapper8" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Faculty</label>
                                        <input class="form-control" type="text" value="{{$doctor->faculty}}" name="faculty" data-parsley-class-handler="#fnWrapper8" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper9" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">University</label>
                                        <input class="form-control" type="text" value="{{$doctor->university}}" name="university" data-parsley-class-handler="#lnWrapper9" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper10" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Grade/GPA</label>
                                        <input class="form-control" type="text" value="{{$doctor->grade}}" name="grade" data-parsley-class-handler="#lnWrapper10" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper11" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Date Obtained</label>
                                        <input class="form-control  datepicker dpd" value="{{$doctor->date}}" data-date-format="dd-mm-yyyy" type="text" name="date" data-parsley-class-handler="#lnWrapper11" autocomplete="off">
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
                            Doctor Finance Data
                          </a>
                        </h6>
                      </div><!-- card-header -->
                      <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="card-block pd-20">
                          <div class="row mg-b-25">
                              <div class="col-lg-6">
                                <div id="fnWrapper6" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Fees Per Day</label>
                                        <input class="form-control" type="text" name="fees_per_day" value="{{$doctor->fees_per_day}}" data-parsley-class-handler="#fnWrapper6" autocomplete="off">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div id="lnWrapper7" class="parsley-input">
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label">Total Fees</label>
                                        <input class="form-control" type="text" name="total_fees" value="{{$doctor->total_fees}}" data-parsley-class-handler="#lnWrapper7" autocomplete="off">
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
                            Select Doctor Service
                          </a>
                        </h6>
                      </div><!-- card-header -->
                      <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour">
                        <div class="card-block pd-20">
                          <div class="row mg-b-25">
                          <div class="col-lg-12">
                              <div class="d-flex">
                                <div id="slWrapper3" class="parsley-select" style="width:100%">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                                    <label class="control-label">Training Courses</label>
                                    <select class="form-control pmd-select2 select2-show-search" name="training_courses[]" data-parsley-class-handler="#slWrapper3"
                                        data-parsley-errors-container="#slErrorContainer3" style="width:100%" multiple>
                                      @foreach($doctor->training as $course)
                                        <option selected value="{{$course->id}}">{{$course->name}}</option>
                                      @endforeach
                                      @foreach($courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                      @endforeach
                                    </select>
                                    <div id="slErrorContainer3"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="d-flex">
                                <div id="slWrapper5" class="parsley-select" style="width:100%">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                                    <label class="control-label">Program Courses</label>
                                    <select class="form-control pmd-select2 select2-show-search" name="program_courses[]" data-parsley-class-handler="#slWrapper5"
                                        data-parsley-errors-container="#slErrorContainer5" style="width:100%" multiple>
                                        @foreach($program_courses as $course)
                                          <option value="{{$course->id}}">{{$course->name}}</option>
                                        @endforeach
                                        @foreach($doctor->programCourses as $course)
                                          <option selected value="{{$course->id}}">{{$course->name}}</option>
                                        @endforeach
                                    </select>
                                    <div id="slErrorContainer5"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="d-flex">
                                <div id="slWrapper7" class="parsley-select" style="width:100%">
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                                    <label class="control-label">Diplom Courses</label>
                                    <select class="form-control pmd-select2 select2-show-search" name="diplom_courses[]" data-parsley-class-handler="#slWrapper7"
                                        data-parsley-errors-container="#slErrorContainer7" style="width:100%" multiple>
                                        @foreach($doctor->diplomCourses as $course)
                                          <option selected value="{{$course->id}}">{{$course->name}}</option>
                                        @endforeach
                                        @foreach($diplom_courses as $course)
                                          <option value="{{$course->id}}">{{$course->name}}</option>
                                        @endforeach
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
                                        <textarea class="form-control" name="notes" data-parsley-class-handler="#fnWrapper99" autocomplete="off">{{$doctor->notes}}</textarea>
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
@include('admin.pages.doctors.edit.scripts')