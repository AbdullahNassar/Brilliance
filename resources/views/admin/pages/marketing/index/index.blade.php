@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Marketing Leads')
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
            <a class="breadcrumb-item" href="{{route('dashboard')}}">Brilliance</a>
            <a class="breadcrumb-item" href="{{route('admin.marketing.leads')}}">Marketing Leads</a>
            <span class="breadcrumb-item active">Marketing Leads Table</span>
        </nav>
        </div><!-- br-pageheader -->
        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <a class="btn btn-oblong btn-outline-primary mg-b-10 float-right" href="{{route('marketing.leads.upload')}}">Upload Leads</a>
                <a class="btn btn-oblong btn-outline-primary mg-b-10 float-right" style="margin-right: 5px;" href="{{route('marketing.leads.add')}}">Add New Lead</a>
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Marketing Leads Table</h6>
                <p class="mg-b-25 mg-lg-b-50">Searching, ordering and paging goodness will be immediately added to the table.</p>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='admin.marketing.leads') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('admin.marketing.leads')}}">All</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='marketing.leads.assigned') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('marketing.leads.assigned')}}">Assigned</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='marketing.leads.unassigned') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('marketing.leads.unassigned')}}">Unassigned</a>
                <form id="assign" method="post">
                {{csrf_field()}}
                    <div class="table-wrapper">
                        <table id="leads_datatable" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Company</th>
                                    <th>Mobile</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leads as $item)
                                    <tr>
                                        <th>{{$loop->index +1}}</th>
                                        <th>{{$item->full_name}}</th>
                                        <th>{{$item->company_name}}</th>
                                        <th>{{$item->phone_number}}</th>
                                        <th>
                                        @if(Route::currentRouteName()=='marketing.leads.unassigned')
                                            <label class="ckbox">
                                                <input id="ckbox{{$item->id}}" name="check{{$item->id}}" type="checkbox">
                                                <span> </span>
                                            </label>
                                            <input id="checked{{$item->id}}" name="checked{{$item->id}}" type="hidden"> 
                                        @else
                                        <a href="{{ route('marketing.leads.edit' , ['id' => $item->id]) }}" class="text-primary edit" title="Edit Lead"><i class="fa fa-edit"></i></a>
                                            <!--<a title="Delete program" href="#" class="text-danger btndelet" id="{{$item->id}}"><i class="fa fa-close"></i></a>-->
                                        @endif
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- table-wrapper -->
                    <br>
                    <div class="form-layout form-layout-1">
                        <div class="row">
                            @if(Route::currentRouteName()=='marketing.leads.unassigned')
                            <div class="col-lg-6">
                                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <label class="control-label">Sales Managers</label>
                                    <select class="form-control select2-show-search" name="sales_id">
                                        <option></option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <button class="btn btn-oblong btn-outline-primary mg-b-10 float-right" type="submit"}}">Assign Selected</button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
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
@endsection
@include('admin.pages.marketing.index.scripts')