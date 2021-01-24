@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Corporates')
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
@section('content')
    <!-- br-mainpanel -->
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('dashboard')}}">Brilliance</a>
            <a class="breadcrumb-item" href="{{route('admin.corporates')}}">Corporates</a>
            <span class="breadcrumb-item active">Corporates Form</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Corporates Form</h4>
        <p class="mg-b-0">Forms are used to collect corporate information with different element types of input, select, checkboxes, radios and more.</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <div class="form-layout form-layout-1">
            <form class="parsley-style-1" id="corporate_form" method="post" data-parsley-validate>
            {{csrf_field()}}
            <div class="row mg-b-25">
            <div class="col-lg-12">
                <div class="user-img-upload">
                  <div class="fileUpload user-editimg">
                      <span><i class="fa fa-camera"></i> Upload</span>
                      <input type="file" id="imgInp" class="upload" name="logo" value="{{$corporate->logo}}">
                  </div>
                  @if($corporate->logo != null)
                  <img src="{{asset('images/corporates/'.$corporate->logo)}}" id="blah" class="img-circle" alt="">
                  @else
                  <img src="{{asset('vendors/img/1.jpg')}}" id="blah" class="img-circle" alt="">
                  @endif
                  <p>Corporate Logo : (1000 x 1000)</p><hr>
                </div>
              </div><!-- col-12 -->
              <div class="col-lg-6">
                <div id="fnWrapper" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Name</label>
                      <input class="form-control" value="{{$corporate->name}}" type="text" name="name" data-parsley-class-handler="#fnWrapper" required>
                      <input value="{{$corporate->id}}" type="hidden" name="id">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper1" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Industry</label>
                      <input class="form-control" value="{{$corporate->industry}}" type="text" name="industry" data-parsley-class-handler="#fnWrapper1" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper2" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Street</label>
                      <input class="form-control" type="text" value="{{$corporate->street}}" name="street" data-parsley-class-handler="#fnWrapper2" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper3" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Area</label>
                      <input class="form-control" type="text" value="{{$corporate->area}}" name="area" data-parsley-class-handler="#fnWrapper3" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper4" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">City</label>
                      <input class="form-control" type="text" value="{{$corporate->city}}" name="city" data-parsley-class-handler="#fnWrapper4" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper5" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Landmark</label>
                      <input class="form-control" type="text" value="{{$corporate->landmark}}" name="landmark" data-parsley-class-handler="#fnWrapper5" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper6" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Country</label>
                      <input class="form-control" type="text" value="{{$corporate->country}}" name="country" data-parsley-class-handler="#fnWrapper6" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper7" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Website</label>
                      <input class="form-control" type="text" value="{{$corporate->website}}" name="website" data-parsley-class-handler="#fnWrapper7" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper8" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Email</label>
                      <input class="form-control" type="email" value="{{$corporate->email}}" name="email" data-parsley-class-handler="#fnWrapper8" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper9" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Mobile</label>
                      <input class="form-control" type="text" value="{{$corporate->mobile}}" name="mobile" data-parsley-class-handler="#fnWrapper9" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper10" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Fax</label>
                      <input class="form-control" type="text" value="{{$corporate->fax}}" name="fax" data-parsley-class-handler="#fnWrapper10" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="d-flex">
                  <div id="slWrapper" class="parsley-select" style="width:100%">
                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                        <label class="control-label">Source</label>
                        <select class="form-control pmd-select2 select2-show-search" name="source" data-parsley-class-handler="#slWrapper"
                          data-parsley-errors-container="#slErrorContainer" style="width:100%" required>
                          <option></option>
                          <option value="Referral" @if($corporate->source == "Referral") selected @endif>Referral</option>
                          <option value="Direct Contact" @if($corporate->source == "Direct Contact") selected @endif>Direct Contact</option>
                          <option value="Eliminy" @if($corporate->source == "Alumni") selected @endif>Alumni</option>
                          <option value="Event" @if($corporate->source == "Event") selected @endif>Event</option>
                        </select>
                        <div id="slErrorContainer"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div id="fnWrapper20" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Source Notes</label>
                      <input class="form-control" type="text" value="{{$corporate->source_note}}" name="source_note" data-parsley-class-handler="#fnWrapper20" autocomplete="off">
                  </div>
                </div>
              </div>
              </div>
              <hr>
              <div class="row mg-b-25 contact">
                <div class="col-lg-6">
                  <h4>Corporate Contacts</h4>
                </div>
                <div class="col-lg-6">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">

                    <a class="btn btn-outline-primary add_form_field3"><i class="fa fa-plus"></i> Add</a>
                  </div>
                </div>
                @php $contacts = 0; @endphp
                @foreach($corporate->contacts as $contact)
                <div class="col-lg-6" id="remove_contact1">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <label class="control-label">Name</label>
                    <input class="form-control" type="text" name="contacts[{{$loop->index}}][name]" value="{{$contact->name}}">
                  </div>
                </div>
                <div class="col-lg-6" id="remove_contact2">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <label class="control-label">Position</label>
                    <input class="form-control" type="text" name="contacts[{{$loop->index}}][position]" value="{{$contact->position}}">
                  </div>
                </div>
                <div class="col-lg-6" id="remove_contact3">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <label class="control-label">Email</label>
                    <input class="form-control" type="text" name="contacts[{{$loop->index}}][email]" value="{{$contact->email}}">
                  </div>
                </div>
                <div class="col-lg-6" id="remove_contact4">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <label class="control-label">Mobile</label>
                    <input class="form-control" type="text" name="contacts[{{$loop->index}}][mobile]" value="{{$contact->mobile}}">
                  </div>
                </div>
                <div class="col-lg-12" id="remove_contact5">
                  <div class="form-group">
                    <label class="ckbox">
                      <input id="ckbox{{$loop->index}}" name="contacts[{{$loop->index}}][default]" type="checkbox" @if($contact->default == 1) value="1" checked @else value="0" @endif>
                      <span>Default</span>
                    </label>
                  </div>
                </div>
                @php $contacts++; @endphp
                @endforeach
                <input type="hidden" class="form-control" name="num3" id="num3"  value="1"/>
                <input type="hidden" class="form-control" name="number3" id="number3"  value="{{$contacts}}"/>
                <div id="old_remove_contact_button" class="col-lg-6">
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
@include('admin.pages.corporates.edit.scripts')