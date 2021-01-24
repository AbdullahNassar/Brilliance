<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />

        <title>
            Initialize Globals Demo - Demos | FullCalendar
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
                    initialDate: "2020-11-07",
                    headerToolbar: {
                        left: "prev,next today",
                        center: "title",
                        right: "dayGridMonth,timeGridWeek,timeGridDay",
                    },
                    events: [
                        {
                            title: "All Day Event",
                            start: "2020-11-01",
                        },
                        {
                            title: "Long Event",
                            start: "2020-11-07",
                            end: "2020-11-10",
                        },
                        {
                            groupId: "999",
                            title: "Repeating Event",
                            start: "2020-11-09T16:00:00",
                        },
                        {
                            groupId: "999",
                            title: "Repeating Event",
                            start: "2020-11-16T16:00:00",
                        },
                        {
                            title: "Conference",
                            start: "2020-11-11",
                            end: "2020-11-13",
                        },
                        {
                            title: "Meeting",
                            start: "2020-11-12T10:30:00",
                            end: "2020-11-12T12:30:00",
                        },
                        {
                            title: "Lunch",
                            start: "2020-11-12T12:00:00",
                        },
                        {
                            title: "Meeting",
                            start: "2020-11-12T14:30:00",
                        },
                        {
                            title: "Birthday Party",
                            start: "2020-11-13T07:00:00",
                        },
                        {
                            title: "Click for Google",
                            url: "http://google.com/",
                            start: "2020-11-28",
                        },
                    ],
                });

                calendar.render();
            });
        </script>
    </head>
    <body>
        <div class="demo-topbar">
            <a class="codepen" href="{{route('admin.doctors')}}"><< Back to Doctors</a>
        </div>
        <div id="calendar"></div>
    </body>
</html>
