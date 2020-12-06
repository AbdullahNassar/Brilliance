@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Program Reports')
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
            <a class="breadcrumb-item" href="{{route('program.reports')}}">Program Reports</a>
            <span class="breadcrumb-item active">Program Reports Table</span>
        </nav>
        </div><!-- br-pageheader -->
        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Program Reports Table</h6>
                <p class="mg-b-25 mg-lg-b-50">Searching, ordering and paging goodness will be immediately added to the table.</p>
                <div class="table-wrapper">
                    <table id="program_datatable" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Program</th>
                                <th>Reasons</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Report Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $item)
                                <tr>
                                    <th>{{$loop->index +1}}</th>
                                    <th>@if($item->program != null) <a target="_blank" href="{{route('program',  ['id'=>$item->program->id ,'slug' => $item->program->translate(app()->getLocale(), true)->slug])}}"> {{$item->program->translate('en', true)->title}} </a> @else Deleted @endif</th>
                                    <th><a href="#" class="view" id="{{$item->id}}">{!! substr($item->report, 0, 20) !!}...</a></th>
                                    <th>{{$item->user->name}}</th>
                                    <th>@if($item->status == 0 || $item->status == null) Pending @elseif($item->status == 2) Ignored @elseif($item->status == 1) Done @endif</th>
                                    <th>{{$item->created_at}}</th>
                                    <th>    
                                        <a title="Change Status" href="#" class="btn btn-danger btndelet" id="{{$item->id}}">Change Status</i></a>     
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
        <div id="delete-modal" class="modal fade" role="dialog" >
            <div class="modal-dialog">
                <div class = "modal-content"  style="text-align: center;">
                    {{csrf_field()}}
                    <div class = "modal-header" >
                        <h4 class = "bold" >Here you can change report status :</h4>
                    </div>
                    <div class = "modal-body">
                        <form method="GET">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-primary done">Mark As Done</button>
                        </form><hr>
                        <form method="GET">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-danger ignore">Mark As Ignored</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>   
        <div id="done-modal" class="modal fade" role="dialog" >
            <div class="modal-dialog">
                <div class = "modal-content"  style="text-align: center;">
                    {{csrf_field()}}
                    <div class = "modal-header" >
                        <h4 class = "bold" >Here you can change report status :</h4>
                    </div>
                    <div class = "modal-body">
                        <form method="GET">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-primary done">Mark As Done</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="ignore-modal" class="modal fade" role="dialog" >
            <div class="modal-dialog">
                <div class = "modal-content"  style="text-align: center;">
                    {{csrf_field()}}
                    <div class = "modal-header" >
                        <h4 class = "bold" >Here you can change report status :</h4>
                    </div>
                    <div class = "modal-body">
                        <form method="GET">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-danger ignore">Mark As Ignored</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <div id="data-modal" class="modal fade" role="dialog" >
            <div class="modal-dialog">
                <div class = "modal-content">
                    {{csrf_field()}}
                    <div class = "modal-header" >
                        <h4 class = "bold" >Report Details :</h4>
                    </div>
                    <div class = "modal-body">
                        <p id="report-details"></p>
                    </div>
                </div>
            </div>
        </div>  
@endsection
@include('admin.pages.reports.programs.scripts')