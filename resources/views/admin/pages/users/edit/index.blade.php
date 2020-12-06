@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Users')
@section('styles')
    <link href="{{asset('vendors/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/bootstrap-summernote/summernote.css')}}" rel="stylesheet">
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
@section('content')
    <!-- br-mainpanel -->
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('dashboard')}}">Brilliance</a>
            <a class="breadcrumb-item" href="{{route('admin.users')}}">Users</a>
            <span class="breadcrumb-item active">Users Form</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Users Form</h4>
        <p class="mg-b-0">Forms are used to collect user information with different element types of input, select, checkboxes, radios and more.</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <div class="form-layout form-layout-1">
            <form class="parsley-style-1" id="user_form" method="post" enctype="multipart/form-data" data-parsley-validate>
            {{csrf_field()}}
            <div class="row mg-b-25">
              <div class="col-lg-12">
                <div class="user-img-upload">
                  <div class="fileUpload user-editimg">
                      <span><i class="fa fa-camera"></i> Upload</span>
                      <input type="file" id="imgInp" class="upload" name="image" value="{{$user->image}}">
                  </div>
                  @if($user->image != null)
                  <img src="{{asset('images/users/'.$user->image)}}" id="blah" class="img-circle" alt="">
                  @else
                  <img src="{{asset('vendors/img/1.jpg')}}" id="blah" class="img-circle" alt="">
                  @endif
                  <p>User Image : (1000 x 1000)</p><hr>
                </div>
              </div><!-- col-12 -->
              <div class="col-lg-6">
                <div id="fnWrapper" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Name</label>
                      <input type="hidden" value="{{$user->id}}" name="id">
                      <input class="form-control" value="{{$user->name}}" type="text" name="name" data-parsley-class-handler="#fnWrapper" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="lnWrapper" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Email</label>
                      <input class="form-control" value="{{$user->email}}" type="email" name="email" data-parsley-class-handler="#lnWrapper" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper1" class="parsley-input">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                        <label class="control-label">Password</label>
                        <input class="form-control" type="password" name="password" data-parsley-class-handler="#fnWrapper1" autocomplete="off">
                    </div>
                </div>
            </div>
              <div class="col-lg-6">
              <div class="d-flex">
                <div id="slWrapper" class="parsley-select" style="width:100%">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Assign Role</label>
                      <select class="form-control pmd-select2 select2-show-search" name="role" data-parsley-class-handler="#slWrapper"
                        data-parsley-errors-container="#slErrorContainer" style="width:100%" required>
                        @foreach($roles as $role)
                          <option value="{{$role->name}}" @if($role->name == $user->role) selected @endif>{{$role->name}}</option>
                        @endforeach
                      </select>
                      <div id="slErrorContainer"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-layout-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div><!-- form-layout-footer -->
            </form>
          </div><!-- form-layout -->
        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->   
@endsection
@include('admin.pages.users.edit.scripts')