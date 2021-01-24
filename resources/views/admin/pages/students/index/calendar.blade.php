<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />

        <title>
            {{$student->name}} {{$student->middle_name}} {{$student->last_name}}
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
                        @foreach($student->studentSchedules as $schedule)
                        @if($schedule->program_id != null)
                        {
                            title: "{{$schedule->programCourse->name}} | {{$schedule->program->name}} | {{$schedule->program->university->name}}",
                            start: "{{$schedule->date}}",
                        },
                        {
                            title: "Class Time",
                            start: "{{$schedule->date}}T{{(new DateTime($schedule->time_from))->format('H:i:s')}}",
                            end: "{{$schedule->date}}T{{(new DateTime($schedule->time_to))->format('H:i:s')}}",
                        },
                        @endif
                        @endforeach
                        @foreach($student->studentSchedules as $schedule)
                        @if($schedule->diplom_id != null)
                        {
                            title: "{{$schedule->diplomCourse->name}} | {{$schedule->diplom->name}} | {{$schedule->diplom->university->name}}",
                            start: "{{$schedule->date}}",
                        },
                        {
                            title: "Class Time",
                            start: "{{$schedule->date}}T{{(new DateTime($schedule->time_from))->format('H:i:s')}}",
                            end: "{{$schedule->date}}T{{(new DateTime($schedule->time_to))->format('H:i:s')}}",
                        },
                        @endif
                        @endforeach
                        @foreach($student->studentSchedules as $schedule)
                        @if($schedule->training_course_id != null)
                        {
                            title: "{{$schedule->training->name}}",
                            start: "{{$schedule->date}}",
                        },
                        {
                            title: "Class Time",
                            start: "{{$schedule->date}}T{{(new DateTime($schedule->time_from))->format('H:i:s')}}",
                            end: "{{$schedule->date}}T{{(new DateTime($schedule->time_to))->format('H:i:s')}}",
                        },
                        @endif
                        @endforeach
                        @foreach($student->studentSchedules as $schedule)
                        @if($schedule->service == "consulting")
                        {
                            title: "Consulting",
                            start: "{{$schedule->date}}",
                        },
                        {
                            title: "Consulting Time",
                            start: "{{$schedule->date}}T{{(new DateTime($schedule->time_from))->format('H:i:s')}}",
                            end: "{{$schedule->date}}T{{(new DateTime($schedule->time_to))->format('H:i:s')}}",
                        },
                        @endif
                        @endforeach
                    ],
                });

                calendar.render();
            });
        </script>
    </head>
    <body>
        <div class="demo-topbar">
            <a class="codepen" href="{{route('admin.students')}}"><< Back to Students</a>
        </div>
        <div class="row">
            <h2 style="text-align:center;">Student : {{$student->name}} {{$student->middle_name}} {{$student->last_name}}</h2>
        </div>
        <div id="calendar"></div>
    </body>
</html>
