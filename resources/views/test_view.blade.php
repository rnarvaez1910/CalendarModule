@extends('admin.layouts.layout')

@section('title', 'Calendario')

@section('content_header')
    <h1>Calendario</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Eventos Arrastrables</h3>
                </div>
                <div class="card-body">
                    <div id="external-events">
                        <div class="external-event bg-success">Reunión</div>
                        <div class="external-event bg-warning">Recordatorio</div>
                        <div class="external-event bg-info">Cumpleaños</div>
                        <div class="external-event bg-danger">Entrega</div>
                        <div class="external-event bg-primary">Otro evento</div>
                        <div class="checkbox">
                            <label for="drop-remove">
                                <input type="checkbox" id="drop-remove">
                                Eliminar después de soltar
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-body p-0">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <style>
        .external-event {
            cursor: move;
            margin: 10px 0;
            padding: 8px 10px;
            color: #fff;
            border-radius: .25rem;
        }
        #external-events {
            padding: 20px;
        }
    </style>
@stop

@section('js')
  <!-- jQuery -->
  <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- JQuery UI -->
  <script src="https://adminlte.io/themes/v3/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- AdminLTE App -->
  <script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js?v=3.2.0"></script>
  <!-- fullCalendar 2.2.5 -->
  <script src="https://adminlte.io/themes/v3/plugins/moment/moment.min.js"></script>
  <script src="https://adminlte.io/themes/v3/plugins/fullcalendar/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            /* initialize the external events */
            function ini_events(ele) {
                ele.each(function() {
                    var eventObject = {
                        title: $.trim($(this).text())
                    };
                    $(this).data('eventObject', eventObject);
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true,
                        revertDuration: 0
                    });
                });
            }

            ini_events($('#external-events div.external-event'));

            /* initialize the calendar */
            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;
            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            // initialize the external events
            new Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color')
                    };
                }
            });

            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                events: [
                    {
                        title: 'Evento largo',
                        start: new Date(y, m, d - 5),
                        end: new Date(y, m, d - 2),
                        backgroundColor: '#f56954',
                        borderColor: '#f56954',
                        allDay: true
                    },
                    {
                        title: 'Reunión',
                        start: new Date(y, m, d, 10, 30),
                        allDay: false,
                        backgroundColor: '#0073b7',
                        borderColor: '#0073b7'
                    },
                    {
                        title: 'Almuerzo',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        allDay: false,
                        backgroundColor: '#00c0ef',
                        borderColor: '#00c0ef'
                    },
                    {
                        title: 'Cumpleaños',
                        start: new Date(y, m, d + 1, 19, 0),
                        end: new Date(y, m, d + 1, 22, 30),
                        allDay: false,
                        backgroundColor: '#00a65a',
                        borderColor: '#00a65a'
                    },
                    {
                        title: 'Click for Google',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        url: 'http://google.com/',
                        backgroundColor: '#3c8dbc',
                        borderColor: '#3c8dbc'
                    }
                ],
                editable: true,
                droppable: true,
                drop: function(info) {
                    if (checkbox.checked) {
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                },
                locale: 'es'
            });

            calendar.render();

            // Botón para agregar nuevos eventos
            $('#add-event').click(function() {
                var title = $('#new-event').val();
                if (title) {
                    var color = $('#event-color').val();
                    var event = $('<div class="external-event" style="background-color:' + color + '">' + title + '</div>');
                    $('#external-events').append(event);
                    ini_events(event);
                    $('#new-event').val('');
                }
            });
        });
    </script>
@stop