@section('scripts')
    <script src="{{asset('vendors/lib/jquery/jquery.js')}}"></script>
    <script src="{{asset('vendors/lib/popper.js/popper.js')}}"></script>
    <script src="{{asset('vendors/lib/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('vendors/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
    <script src="{{asset('vendors/lib/moment/moment.js')}}"></script>
    <script src="{{asset('vendors/lib/jquery-ui/jquery-ui.js')}}"></script>
    <script src="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.js')}}"></script>
    <script src="{{asset('vendors/lib/peity/jquery.peity.js')}}"></script>
    <script src="{{asset('vendors/js/bracket.js')}}"></script>
    <script src="{{asset('vendors/fullcalendar/lib/main.min.js')}}"></script>
    <script>
            document.addEventListener("DOMContentLoaded", function () {
                var calendarEl = document.getElementById("calendar");

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: "dayGridMonth",
                    initialDate: "2021-01-01",
                    headerToolbar: {
                        left: "prev,next today",
                        center: "title",
                        right: "dayGridMonth,timeGridWeek,timeGridDay",
                    },
                    events: [
                        @foreach($halls as $s)
                        {
                            title: "{{$s->hall->name}}",
                            start: "{{$s->date}}",
                        },
                        {
                            title: "{{$s->hall->name}}",
                            start: "{{$s->date}}T{{(new DateTime($s->time_from))->format('H:i:s')}}",
                            end: "{{$s->date}}T{{(new DateTime($s->time_to))->format('H:i:s')}}",
                        },
                        @endforeach
                    ],
                });

                calendar.render();
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
@endsection