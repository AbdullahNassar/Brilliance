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
    <link href="{{asset('vendors/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jt.timepicker/jquery.timepicker.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/spectrum/spectrum.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/ion.rangeSlider/css/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
    
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('vendors/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/bracket.css')}}">
    <link href="{{asset('vendors/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/css/float-labels.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- br-mainpanel -->
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('dashboard')}}">Marj3</a>
            <a class="breadcrumb-item" href="{{route('admin.articles')}}">Articles</a>
            <span class="breadcrumb-item active">Articles Table</span>
        </nav>
        </div><!-- br-pageheader -->
        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <a class="btn btn-oblong btn-outline-primary mg-b-10 float-right" href="{{route('articles.add')}}">Add New</a>
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Articles Table</h6>
                <p class="mg-b-25 mg-lg-b-50">Searching, ordering and paging goodness will be immediately added to the table.</p>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='admin.articles') background-color: #39b586; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('admin.articles')}}">All</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='articles.published') background-color: #39b586; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('articles.published')}}">Published</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='articles.unpublished') background-color: #39b586; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('articles.unpublished')}}">Unpublished</a>
                <a @if(Route::currentRouteName()=='articles.reported') style="background-color: #39b586; color: #ffffff;" @endif class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('articles.reported')}}">Reported</a>
                <div class="table-wrapper">
                    <table id="articles_datatable" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th >Image</th>
                                <th >Title</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $item)
                                <tr>
                                    <th><img src="{{asset('images/articles/'.$item->image)}}" class="wd-150" alt="logo"></th>
                                    @if($item->translate('en', true)->title == null)
                                    <th>{{$item->translate('ar', true)->title}}</th>
                                    @else
                                    <th>{{$item->translate('en', true)->title}}</th>
                                    @endif
                                    <th>{{$item->user->name}}</th>
                                    <th>@if($item->status == 1) Published @else Draft @endif @if($item->report == 1) , Reported @endif</th>
                                    <th><a target="_blank" href="{{ route('articles.edit' , ['id' => $item->id]) }}" class="text-primary edit" title="Edit Article"><i class="fa fa-edit"></i></a>     
                                        <a title="Delete Article" href="#" class="text-danger btndelet" id="{{$item->id}}"><i class="fa fa-close"></i></a>     
                                        @if($item->status == 1)
                                        @if($item->translate(app()->getLocale(), true)->title == null || $item->translate(app()->getLocale(), true)->slug == null)
                                            <a target="_blank" href="{{ route('articles') }}" class="text-primary view" title="View Article"><i class="fa fa-eye"></i></a>
                                        @elseif($item->translate(app()->getLocale(), true)->title != null  && $item->translate(app()->getLocale(), true)->slug != null)
                                            <a target="_blank" href="{{ route('article' , ['id'=>$item->id ,'slug' => $item->translate(app()->getLocale(), true)->slug]) }}" class="text-primary view" title="View Article"><i class="fa fa-eye"></i></a>
                                        @endif
                                        <form method="POST" action="{{route('article.unpublish', ['id' => $item->id])}}">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-danger">Unpublish</button>
                                        </form>
                                        <!--<form method="POST" action="{{route('article.publish', ['id' => $item->id])}}">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-primary">Publish</button>
                                        </form>-->
                                        @endif
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
        <!-- modal -->
        <div id="delete-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class = "modal-content" >
                    {{csrf_field()}}
                    <div class = "modal-header" >
                        <h4 class = "bold" >Are you sure you want to Delete this data?</h4>
                    </div>
                    <div class = "modal-body" >
                        <p >Note : all the data related to this item will be deleted also!</p>
                    </div>
                    <div class = "modal-footer" >
                        <a href = "#" class = "btn btn-danger btndel">Delete</a>
                        <button type = "button" class = "btn btn-default" data-dismiss = "modal" >Close</button >
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->  
@endsection
@include('admin.pages.articles.index.scripts')