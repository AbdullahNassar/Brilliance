@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Sales Leads')
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
            <a class="breadcrumb-item" href="{{route('admin.sales.manager.leads')}}">Sales Leads</a>
            <span class="breadcrumb-item active">Sales Leads Table</span>
        </nav>
        </div><!-- br-pageheader -->
        <div class="br-pagebody">
            <div class="br-section-wrapper">
                @if(Route::currentRouteName()=='admin.sales.manager.leads')<a class="btn btn-oblong btn-outline-primary mg-b-10 float-right" href="{{route('sales.leads.upload')}}">Upload Leads</a>@endif
                <a class="btn btn-oblong btn-outline-primary mg-b-10 float-right" style="margin-right: 5px;" href="{{route('tickets.add')}}">Add New Ticket</a>
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Sales Leads Table</h6>
                <p class="mg-b-25 mg-lg-b-50">Searching, ordering and paging goodness will be immediately added to the table.</p>
                @if(Route::currentRouteName()=='admin.sales.manager.leads' || Route::currentRouteName()=='sales.leads.assigned' || Route::currentRouteName()=='sales.leads.unassigned' || Route::currentRouteName()=='sales.manager.follow' || Route::currentRouteName()=='sales.manager.potential' || Route::currentRouteName()=='sales.manager.hold' || Route::currentRouteName()=='sales.manager.noAnswer' || Route::currentRouteName()=='sales.manager.interested' || Route::currentRouteName()=='sales.manager.outOfReach' || Route::currentRouteName()=='sales.manager.closed')
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='admin.sales.manager.leads') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('admin.sales.manager.leads')}}">All</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='sales.leads.assigned') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('sales.leads.assigned')}}">Assigned</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='sales.leads.unassigned') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('sales.leads.unassigned')}}">Unassigned</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='sales.manager.follow') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('sales.manager.follow')}}">Follow Up</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='sales.manager.potential') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('sales.manager.potential')}}">Potential</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='sales.manager.hold') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('sales.manager.hold')}}">Hold</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='sales.manager.noAnswer') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('sales.manager.noAnswer')}}">No Answer</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='sales.manager.interested') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('sales.manager.interested')}}">Interested</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='sales.manager.outOfReach') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('sales.manager.outOfReach')}}">Out Of Reach</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='sales.manager.closed') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('sales.manager.closed')}}">Closed</a>
                @endif
                @if(Route::currentRouteName()=='admin.sales.advisor.leads' || Route::currentRouteName()=='sales.leads.follow' || Route::currentRouteName()=='sales.leads.potential' || Route::currentRouteName()=='sales.leads.hold' || Route::currentRouteName()=='sales.leads.noAnswer' || Route::currentRouteName()=='sales.leads.interested' || Route::currentRouteName()=='sales.leads.outOfReach' || Route::currentRouteName()=='sales.leads.closed')
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='admin.sales.advisor.leads') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('admin.sales.advisor.leads')}}">All</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='sales.leads.follow') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('sales.leads.follow')}}">Follow Up</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='sales.leads.potential') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('sales.leads.potential')}}">Potential</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='sales.leads.hold') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('sales.leads.hold')}}">Hold</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='sales.leads.noAnswer') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('sales.leads.noAnswer')}}">No Answer</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='sales.leads.interested') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('sales.leads.interested')}}">Interested</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='sales.leads.outOfReach') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('sales.leads.outOfReach')}}">Out Of Reach</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='sales.leads.closed') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('sales.leads.closed')}}">Closed</a>
                @endif
                <form id="assign" method="post">
                {{csrf_field()}}
                    <div class="table-wrapper">
                        <table id="leads_datatable" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th> </th>
                                    <th>Full Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    @if(Route::currentRouteName()=='sales.leads.assigned') <th>Advisor</th>@endif
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leads as $item)
                                    <tr>
                                        <th>{{$loop->index +1}}</th>
                                        <th><a href="{{ route('lead.profile' , ['id' => $item->id]) }}">{{$item->full_name}}</a></th>
                                        <th>{{$item->phone_number}}</th>
                                        <th>{{$item->email}}</th>
                                        <th>{{$item->activity_status}} @if($item->next_call != null) | {{$item->next_call}} @endif</th>
                                        @if(Route::currentRouteName()=='sales.leads.assigned') <th>{{$item->user->name}}</th>@endif
                                        <th>
                                        @if(Route::currentRouteName()=='sales.leads.unassigned' || Route::currentRouteName()=='sales.leads.assigned')
                                            <label class="ckbox">
                                                <input id="ckbox{{$item->id}}" name="check{{$item->id}}" type="checkbox">
                                                <span> </span>
                                            </label>
                                            <input value="{{$item->id}}" id="checked{{$item->id}}" name="checked{{$item->id}}" type="hidden">
                                        @elseif(Route::currentRouteName()=='sales.leads.unassigned' || Route::currentRouteName()=='sales.leads.assigned' || Route::currentRouteName()=='sales.manager.follow' || Route::currentRouteName()=='sales.manager.potential' || Route::currentRouteName()=='sales.manager.hold' || Route::currentRouteName()=='sales.manager.noAnswer' || Route::currentRouteName()=='sales.manager.interested' || Route::currentRouteName()=='sales.manager.outOfReach' || Route::currentRouteName()=='sales.manager.closed')
                                            <label class="ckbox">
                                                <input id="ckbox{{$item->id}}" name="check{{$item->id}}" type="checkbox">
                                                <span> </span>
                                            </label>
                                            <input value="{{$item->id}}" id="checked{{$item->id}}" name="checked{{$item->id}}" type="hidden">
                                        @elseif(Route::currentRouteName()=='admin.sales.advisor.leads' || Route::currentRouteName()=='sales.leads.follow' || Route::currentRouteName()=='sales.leads.potential' || Route::currentRouteName()=='sales.leads.hold' || Route::currentRouteName()=='sales.leads.noAnswer' || Route::currentRouteName()=='sales.leads.interested' || Route::currentRouteName()=='sales.leads.outOfReach' || Route::currentRouteName()=='sales.leads.closed')
                                            <a href="{{ route('sales.activity.add' , ['id' => $item->id]) }}" class="text-primary edit" title="Add Activity"><i class="fa fa-edit"></i></a> 
                                            <label class="ckbox">
                                                <input id="ckbox{{$item->id}}" name="check{{$item->id}}" type="checkbox">
                                                <span> </span>
                                            </label>
                                            <input value="{{$item->id}}" id="checked{{$item->id}}" name="checked{{$item->id}}" type="hidden">
                                        @else
                                            <a href="{{ route('sales.activity.add' , ['id' => $item->id]) }}" class="text-primary edit" title="Add Activity"><i class="fa fa-edit"></i></a> 
                                        @endif
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- table-wrapper -->
                    @if(Route::currentRouteName()=='sales.leads.unassigned' || Route::currentRouteName()=='sales.leads.assigned' || Route::currentRouteName()=='sales.manager.follow' || Route::currentRouteName()=='sales.manager.potential' || Route::currentRouteName()=='sales.manager.hold' || Route::currentRouteName()=='sales.manager.noAnswer' || Route::currentRouteName()=='sales.manager.interested' || Route::currentRouteName()=='sales.manager.outOfReach' || Route::currentRouteName()=='sales.manager.closed')
                    <br>
                    <input value="1" name="status" type="hidden">
                    <div class="form-layout form-layout-1">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <label class="control-label">Sales Advisors</label>
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
                        </div>
                    </div>
                    @elseif(Route::currentRouteName()=='admin.sales.advisor.leads' || Route::currentRouteName()=='sales.leads.follow' || Route::currentRouteName()=='sales.leads.potential' || Route::currentRouteName()=='sales.leads.hold' || Route::currentRouteName()=='sales.leads.noAnswer' || Route::currentRouteName()=='sales.leads.interested' || Route::currentRouteName()=='sales.leads.outOfReach' || Route::currentRouteName()=='sales.leads.closed')
                    <br>
                    <input value="0" name="status" type="hidden">
                    <div class="form-layout form-layout-1">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <label class="control-label">Sales Managers</label>
                                    <select class="form-control select2-show-search" name="sales_id">
                                        <option></option>
                                        @foreach($managers as $manager)
                                            <option value="{{$manager->id}}">{{$manager->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <button class="btn btn-oblong btn-outline-primary mg-b-10 float-right" type="submit"}}">Reassign Selected</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    @endif
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
@include('admin.pages.sales.index.scripts')