@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Articles')
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
    <link rel="stylesheet" href="{{ asset('vendors/css/croppie.min.css') }}">

@endsection
@section('content')
    <!-- br-mainpanel -->
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('dashboard')}}">Marj3</a>
            <a class="breadcrumb-item" href="{{route('admin.articles')}}">Articles</a>
            <span class="breadcrumb-item active">Articles Form</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Articles Form</h4>
        <p class="mg-b-0">Forms are used to collect user information with different element types of input, select, checkboxes, radios and more.</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <div class="form-layout form-layout-1">
            <form class="parsley-style-1" id="article_form" method="post" enctype="multipart/form-data" data-parsley-validate>
            {{csrf_field()}}
            <div class="row mg-b-25">
              <!--<div class="col-lg-12">
                <div class="user-img-upload">
                  <div class="fileUpload user-editimg">
                      <span><i class="fa fa-camera"></i> Upload</span>
                      <input type="file" id="imgInp" class="upload" name="image" value="{{$article->image}}">
                  </div>
                  @if($article->image != null)
                  <img src="{{asset('images/articles/'.$article->image)}}" id="blah" class="img-circle" alt="">
                  @else
                  <img src="{{asset('vendors/img/1.jpg')}}" id="blah" class="img-circle" alt="">
                  @endif
                  <p>Article Image : (1200 x 453)</p><hr>
                </div>
              </div>-->
              <div class="col-md-12 text-center">
                <div id="image-preview"></div>
              </div>
              <div class="col-md-12 text-center" style="padding:5%; width:100%;">
                <p>Choose image</p>
                <input type="hidden" name="image_name" id="image_name" value="{{$article->image}}">
                <input type="file" name="upload_image" id="upload_image" /><br><br>
                <a class="btn btn-primary btn-block crop_image" style="margin-top:10px; width:100%;">Upload Image</a>
                <div class="alert alert-success text-center" id="upload-success" style="display: none;margin-top:10px; width: 100%;"></div>
              </div>
              <div class="col-md-12 text-center">
                <div id="uploaded_image" style="background:#9d9d9d;width:100%;padding:15px 15px;height:400px; margin-bottom: 30px;">
                @if($article->image != null)
                  <img src="{{asset('images/articles/'.$article->image)}}" id="blah" style="max-height:360px;max-width:670px;">
                @else
                  <input type="hidden" id="blah">
                @endif
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Title in English</label>
                      <input type="hidden" value="{{$article->id}}" name="id">
                      <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                      <input class="form-control" value="{{$article->translate('en', true)->title}}" type="text" name="translatedAttrs[en][title]" data-parsley-class-handler="#fnWrapper">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="lnWrapper" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Title in Arabic</label>
                      <input class="form-control" value="{{$article->translate('ar', true)->title}}" type="text" name="translatedAttrs[ar][title]" data-parsley-class-handler="#lnWrapper" dir="rtl">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper" class="parsley-input">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                        <label class="control-label">Slug in English</label>
                        <input class="form-control" value="{{$article->translate('en', true)->slug}}" type="text" name="translatedAttrs[en][slug]" data-parsley-class-handler="#fnWrapper">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div id="lnWrapper" class="parsley-input">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                        <label class="control-label">Slug in Arabic</label>
                        <input class="form-control" value="{{$article->translate('ar', true)->slug}}" type="text" name="translatedAttrs[ar][slug]" data-parsley-class-handler="#lnWrapper" dir="rtl">
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
              <div class="d-flex">
                <div id="slWrapper" class="parsley-select" style="width:100%">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Category</label>
                      <select class="form-control pmd-select2 select2-show-search" name="categories[]" data-parent="#accordion" data-parsley-class-handler="#slWrapper"
                        data-parsley-errors-container="#slErrorContainer" style="width:100%" multiple>
                        @if($article->groups != null)
                        @foreach($article->groups as $g)
                        @if($loop->index == 0)
                          @foreach($groups as $group) @if($group->id != $g->id) <option value="{{$group->id}}">{{$group->translate('en', true)->name}}</option> @endif @endforeach
                        @endif
                        @endforeach
                        @foreach($article->groups as $gr)  <option value="{{$gr->id}}" selected >{{$gr->translate('en', true)->name}}</option> @endforeach
                        @else
                          @foreach($groups as $group) <option value="{{$group->id}}">{{$group->translate('en', true)->name}}</option> @endforeach
                        @endif
                      </select>
                      <div id="slErrorContainer"></div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label class="ckbox">
                  <input id="ckbox1" name="top" type="checkbox" @if($article->top == 1) value="1" checked @else value="0" @endif>
                  <span>Top article?</span>
                </label>
              </div>
            </div>
            <div class="col-lg-6">
              <div id="fnWrapper" class="parsley-input">
                  <div class="form-group">
                      <label class="control-label">Content in English</label>
                      <textarea rows="7" class="form-control summernote1" name="translatedAttrs[en][content]" data-parsley-class-handler="#fnWrapper">{{$article->translate('en', true)->content}}</textarea>
                  </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div id="lnWrapper" class="parsley-input">
                  <div class="form-group">
                      <label class="control-label">Content in Arabic</label>
                      <textarea dir="rtl" rows="7" class="form-control summernote2" name="translatedAttrs[ar][content]" data-parsley-class-handler="#lnWrapper">{{$article->translate('ar', true)->content}}</textarea>
                  </div>
              </div>
            </div>
            </div><!-- row -->
            @if($article->status == 1)
            <div class="form-layout-footer">
              <input type="hidden" name="submitbutton" id="submitbutton">
              <button type="submit" id="draft" class="btn btn-primary">Unpublish</button>
              <button type="submit" id="publish" class="btn btn-primary">Save</button>
              @if($article->translate(app()->getLocale(), true)->slug == null)
                <a target="_blank" href="{{ route('articles') }}" class="btn btn-info" title="View Article">View Article</a>
              @elseif($article->translate(app()->getLocale(), true)->slug != null)
                <a target="_blank" href="{{ route('article' , [$locale,'id'=>$article->id ,'slug' => $article->translate(app()->getLocale(), true)->slug]) }}" class="btn btn-info">View Article</a>
              @endif
            </div><!-- form-layout-footer -->
            @else
            <div class="form-layout-footer">
              <input type="hidden" name="submitbutton" id="submitbutton">
              <button type="submit" id="publish" class="btn btn-primary">Publish</button>
              <button type="submit" id="draft" class="btn btn-primary">Save</button>
              @if($article->translate(app()->getLocale(), true)->slug == null)
                <a target="_blank" href="{{ route('articles') }}" class="btn btn-info" title="View Article">View Article</a>
              @elseif($article->translate(app()->getLocale(), true)->slug != null)
                <a target="_blank" href="{{ route('article' , [$locale,'id'=>$article->id ,'slug' => $article->translate(app()->getLocale(), true)->slug]) }}" class="btn btn-info">View Article</a>
              @endif
            </div><!-- form-layout-footer -->
            @endif
            </form>
          </div><!-- form-layout -->
        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->   
@endsection
@include('admin.pages.articles.edit.scripts')