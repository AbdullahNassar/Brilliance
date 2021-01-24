@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Upload Student Documents')
@section('styles')
    <link href="{{asset('vendors/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/bootstrap-summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
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
            <a class="breadcrumb-item" href="{{route('admin.students')}}">Students</a>
            <span class="breadcrumb-item active">Upload Student Documents Form</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Upload Student Documents Form</h4>
        <p class="mg-b-0">Forms are used to collect document information with different element types of input, select, checkboxes, radios and more.</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <div class="form-layout form-layout-1">
            <form class="parsley-style-1" id="document_form" method="post" data-parsley-validate>
                {{csrf_field()}}
                <input type="hidden" value="{{$student->id}}" name="id">
                <div class="row mg-b-25 align-items-center">
                    <div class="col-lg-12">
                        <div class="bd bd-gray-300 rounded table-responsive">
                            <table class="table mg-b-0">
                                <thead>
                                    <tr>
                                        <th>Document Type</th>
                                        <th>File</th>
                                        <th>Download Link</th>
                                        <th>Check</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($student_documents as $document)
                                        @if($document->student_id == $student->id)
                                            <tr>
                                                @foreach($documents as $d)
                                                @if($document->document_id == $d->id)
                                                    <th>{{$d->name}}</th>
                                                @endif
                                                @endforeach
                                                <td>{{$document->file}}</td>
                                                <td><a target="_blank" href="{{asset("images/students/documents/$document->file")}}"><i class="fa fa-eye"></i></a></td>
                                                <td>
                                                <label class="ckbox">
                                                    <input id="ckbox{{$loop->index+1}}" type="checkbox" checked>
                                                    <span>Uploaded</span>
                                                </label>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group custom-inputfile" style="margin-left: 10px !important;">
                            <input type="file" name="statement" id="file-6" class="inputfile inputfile-6">
                            <label for="file-6"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg>Choose File&hellip;</strong></label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex">
                            <div id="slWrapper99" class="parsley-select" style="width: 100%; margin-bottom: 10px !important;">
                                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <label class="control-label">Document Type</label>
                                    <select class="form-control pmd-select2 select2-show-search" name="document_id" data-parsley-class-handler="#slWrapper99"
                                            data-parsley-errors-container="#slErrorContainer" style="width: 100%;" required>
                                        <option></option>
                                        @foreach($student_required_documents as $d)
                                            <option value="{{$d->id}}">{{$d->name}}</option>
                                        @endforeach
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
            </form>
          </div><!-- form-layout -->
        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->   
@endsection
@include('admin.pages.students.index.scripts')