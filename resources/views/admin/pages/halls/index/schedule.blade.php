<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />

        <title>
            Schedule
        </title>

        <link href="/assets/demo-to-codepen.css" rel="stylesheet" />

        <style>
            html,
            body {
                margin: 0;
                padding: 0;
                font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
                font-size: 14px;
            }

            #calendar {
                max-width: 1100px;
                margin: 40px auto;
            }
            .codepen{
                color: #000;
                text-decoration: none;
                text-align: center;
                margin-left: 20px;
                margin-top: 20px !important;
            }
        </style>

        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.4.0/main.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.4.0/main.min.js"></script>

        <script src="/assets/demo-to-codepen.js"></script>

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
                            title: "{{$s->hall->name}} @if($s->program_course_id != null) | {{$s->programCourse->name}} @elseif($s->diplom_course_id != null) | {{$s->diplomCourse->name}} @elseif($s->training_course_id != null) | {{$s->trainingCourse->name}} @endif | {{$s->type}} | {{$s->doctor->name}}",
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
    </head>
    <body>
        <div class="demo-topbar">
            <a class="codepen" href="{{route('dashboard')}}"><< Back to Dashboard</a>
        </div>
        <div class="row">
            <h2 style="text-align:center;">Brilliance Schedule</h2>
        </div>
        <div id="calendar"></div>
    </body>
</html>
