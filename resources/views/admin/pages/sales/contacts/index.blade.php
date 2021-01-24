@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Contacts')
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
            <a class="breadcrumb-item" href="{{route('admin.sales.manager.leads')}}">Contacts</a>
            <span class="breadcrumb-item active">Contacts Table</span>
        </nav>
        </div><!-- br-pageheader -->
        <div class="br-pagebody">
            <div class="br-section-wrapper">
                @if(Route::currentRouteName()=='admin.sales.manager.leads')<a class="btn btn-oblong btn-outline-primary mg-b-10 float-right" href="{{route('sales.leads.upload')}}">Upload Leads</a>@endif
                <a class="btn btn-oblong btn-outline-primary mg-b-10 float-right" style="margin-right: 5px;" href="{{route('tickets.add')}}">Add New Ticket</a>
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Contacts Table</h6>
                <p class="mg-b-25 mg-lg-b-50">Searching, ordering and paging goodness will be immediately added to the table.</p>
                    <div class="table-wrapper">
                        <table id="leads_datatable" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Job Title</th>
                                    <th>Company</th>
                                    <th>Advisor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leads as $item)
                                    <tr>
                                        <th>{{$item->full_name}}</th>
                                        <th>{{$item->phone_number}}</th>
                                        <th>{{$item->email}}</th>
                                        <th>{{$item->job_title}}</th>
                                        <th>{{$item->company_name}}</th>
                                        <th>{{$item->user->name}}</th>
                                        <!--<th>
                                            <a href="{{ route('sales.activity.add' , ['id' => $item->id]) }}" class="text-primary edit" title="Add Activity"><i class="fa fa-edit"></i></a> 
                                        </th>-->
                                    </tr>
                                @endforeach
                                @foreach($applicants as $item)
                                    <tr>
                                        <th>{{$item->name}} {{$item->last_name}}</th>
                                        <th>{{$item->mobile1}}</th>
                                        <th>{{$item->email1}}</th>
                                        <th>{{$item->job}}</th>
                                        <th>{{$item->corporate->name}}</th>
                                        <th>{{$item->user->name}}</th>
                                        <!--<th>
                                            <a href="{{ route('sales.activity.add' , ['id' => $item->id]) }}" class="text-primary edit" title="Add Activity"><i class="fa fa-edit"></i></a> 
                                        </th>-->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- table-wrapper -->
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