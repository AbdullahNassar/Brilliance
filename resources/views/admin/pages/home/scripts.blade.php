@section('scripts')
    @if(Auth::user()->role == "admin" || Auth::user()->role == "ceo")
        <script src="{{asset('vendors/lib/jquery/jquery.js')}}"></script>
        <script src="{{asset('vendors/lib/jquery/jquery.js')}}"></script>
        <script src="{{asset('vendors/lib/popper.js/popper.js')}}"></script>
        <script src="{{asset('vendors/lib/bootstrap/bootstrap.js')}}"></script>
        <script src="{{asset('vendors/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
        <script src="{{asset('vendors/lib/moment/moment.js')}}"></script>
        <script src="{{asset('vendors/lib/jquery-ui/jquery-ui.js')}}"></script>
        <script src="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.js')}}"></script>
        <script src="{{asset('vendors/lib/peity/jquery.peity.js')}}"></script>
        <script src="{{asset('vendors/lib/chartist/chartist.js')}}"></script>
        <script src="{{asset('vendors/lib/jquery.sparkline.bower/jquery.sparkline.min.js')}}"></script>
        <script src="{{asset('vendors/lib/d3/d3.js')}}"></script>
        <script src="{{asset('vendors/lib/rickshaw/rickshaw.min.js')}}"></script>
        <script src="{{asset('vendors/js/bracket.js')}}"></script>
        <script src="{{asset('vendors/js/ResizeSensor.js')}}"></script>
        <script src="{{asset('vendors/js/dashboard.js')}}"></script>
        <script src="{{asset('vendors/js/jquery.nicescroll.min.js')}}"></script>
        <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }
        </script>
        <script>
        $(function(){
            'use strict'

            // FOR DEMO ONLY
            // menu collapsed by default during first page load or refresh with screen
            // having a size between 992px and 1299px. This is intended on this page only
            // for better viewing of widgets demo.
            $(window).resize(function(){
            minimizeMenu();
            });

            function minimizeMenu() {
            if(window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)').matches) {
                // show only the icons and hide left menu label by default
                $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
                $('body').addClass('collapsed-menu');
                $('.show-sub + .br-menu-sub').slideUp();
            } else if(window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
                $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
                $('body').removeClass('collapsed-menu');
                $('.show-sub + .br-menu-sub').slideDown();
            }
            }
        });
        </script>

        <script type="text/javascript">
            /* Nice Scroll 
            $(document).ready(function() {

                "use strict";

                $("html").niceScroll({
                    scrollspeed: 0.1,
                    mousescrollstep: 35,
                    cursorwidth: 5,
                    cursorcolor: '#b02e2e54',
                    cursorborder: 'none',
                    background: 'rgb(176 46 46 / 38%)',
                    cursorborderradius: 3,
                    autohidemode: false,
                    cursoropacitymin: 0.1,
                    cursoropacitymax: 1,
                    zindex: "999",
                    horizrailenabled: false
                });

            });*/
        </script>
    @elseif(Auth::user()->role == "marketing")
        <script src="{{asset('vendors/lib/jquery/jquery.js')}}"></script>
        <script src="{{asset('vendors/lib/jquery/jquery.js')}}"></script>
        <script src="{{asset('vendors/lib/popper.js/popper.js')}}"></script>
        <script src="{{asset('vendors/lib/bootstrap/bootstrap.js')}}"></script>
        <script src="{{asset('vendors/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
        <script src="{{asset('vendors/lib/moment/moment.js')}}"></script>
        <script src="{{asset('vendors/lib/jquery-ui/jquery-ui.js')}}"></script>
        <script src="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.js')}}"></script>
        <script src="{{asset('vendors/lib/peity/jquery.peity.js')}}"></script>
        <script src="{{asset('vendors/lib/datatables/jquery.dataTables.js')}}"></script>
        <script src="{{asset('vendors/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
        <script src="{{asset('vendors/lib/jquery.sparkline.bower/jquery.sparkline.min.js')}}"></script>
        <script src="{{asset('vendors/lib/d3/d3.js')}}"></script>
        <script src="{{asset('vendors/js/bracket.js')}}"></script>
        <script src="{{asset('vendors/js/ResizeSensor.js')}}"></script>
        <script src="{{asset('vendors/js/jquery.nicescroll.min.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                var t = $('#marketing_datatable').DataTable({
                    "columnDefs": [ {
                        "searchable": false,
                        "orderable": false,
                        "targets": 0
                    }],
                    "columns": [
                        { "orderable": true },
                        { "orderable": true },
                        { "orderable": true },
                        { "orderable": true },
                        { "orderable": true },
                        { "orderable": true },
                    ],
                    responsive: true,
                    "order": [[ 1, 'asc' ]],
                    "pageLength": 10,
                    language: {
                        searchPlaceholder: 'Search...',
                        sSearch: '',
                        lengthMenu: 'show _MENU_ items',
                    }
                });
                t.on( 'order.dt search.dt', function () {
                    t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                    } );
                } ).draw();
            });
        </script>
        <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }
        </script>
    @elseif(Auth::user()->role == "sales")
        <script src="{{asset('vendors/lib/jquery/jquery.js')}}"></script>
        <script src="{{asset('vendors/lib/jquery/jquery.js')}}"></script>
        <script src="{{asset('vendors/lib/popper.js/popper.js')}}"></script>
        <script src="{{asset('vendors/lib/bootstrap/bootstrap.js')}}"></script>
        <script src="{{asset('vendors/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
        <script src="{{asset('vendors/lib/moment/moment.js')}}"></script>
        <script src="{{asset('vendors/lib/jquery-ui/jquery-ui.js')}}"></script>
        <script src="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.js')}}"></script>
        <script src="{{asset('vendors/lib/peity/jquery.peity.js')}}"></script>
        <script src="{{asset('vendors/lib/datatables/jquery.dataTables.js')}}"></script>
        <script src="{{asset('vendors/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
        <script src="{{asset('vendors/lib/jquery.sparkline.bower/jquery.sparkline.min.js')}}"></script>
        <script src="{{asset('vendors/lib/d3/d3.js')}}"></script>
        <script src="{{asset('vendors/js/bracket.js')}}"></script>
        <script src="{{asset('vendors/js/ResizeSensor.js')}}"></script>
        <script src="{{asset('vendors/js/jquery.nicescroll.min.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                var t = $('#sales_datatable').DataTable({
                    "columnDefs": [ {
                        "searchable": false,
                        "orderable": false,
                        "targets": 0
                    }],
                    "columns": [
                        { "orderable": true },
                        { "orderable": true },
                        { "orderable": true },
                        { "orderable": true },
                        { "orderable": true },
                        { "orderable": true },
                    ],
                    responsive: true,
                    "order": [[ 1, 'asc' ]],
                    "pageLength": 10,
                    language: {
                        searchPlaceholder: 'Search...',
                        sSearch: '',
                        lengthMenu: 'show _MENU_ items',
                    }
                });
                t.on( 'order.dt search.dt', function () {
                    t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                    } );
                } ).draw();
            });
        </script>
        <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }
        </script>
    @elseif(Auth::user()->role == "sales-manager")
        <script src="{{asset('vendors/lib/jquery/jquery.js')}}"></script>
        <script src="{{asset('vendors/lib/jquery/jquery.js')}}"></script>
        <script src="{{asset('vendors/lib/popper.js/popper.js')}}"></script>
        <script src="{{asset('vendors/lib/bootstrap/bootstrap.js')}}"></script>
        <script src="{{asset('vendors/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
        <script src="{{asset('vendors/lib/moment/moment.js')}}"></script>
        <script src="{{asset('vendors/lib/jquery-ui/jquery-ui.js')}}"></script>
        <script src="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.js')}}"></script>
        <script src="{{asset('vendors/lib/peity/jquery.peity.js')}}"></script>
        <script src="{{asset('vendors/lib/datatables/jquery.dataTables.js')}}"></script>
        <script src="{{asset('vendors/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
        <script src="{{asset('vendors/lib/jquery.sparkline.bower/jquery.sparkline.min.js')}}"></script>
        <script src="{{asset('vendors/lib/d3/d3.js')}}"></script>
        <script src="{{asset('vendors/js/bracket.js')}}"></script>
        <script src="{{asset('vendors/js/ResizeSensor.js')}}"></script>
        <script src="{{asset('vendors/js/jquery.nicescroll.min.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                var t = $('#manager_datatable').DataTable({
                    "columnDefs": [ {
                        "searchable": false,
                        "orderable": false,
                        "targets": 0
                    }],
                    "columns": [
                        { "orderable": true },
                        { "orderable": true },
                        { "orderable": true },
                        { "orderable": true },
                        { "orderable": true },
                        { "orderable": true },
                    ],
                    responsive: true,
                    "order": [[ 1, 'asc' ]],
                    "pageLength": 10,
                    language: {
                        searchPlaceholder: 'Search...',
                        sSearch: '',
                        lengthMenu: 'show _MENU_ items',
                    }
                });
                t.on( 'order.dt search.dt', function () {
                    t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                    } );
                } ).draw();
            });
        </script>
        <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }
        </script>
    @endif
@endsection