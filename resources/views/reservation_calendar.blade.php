@extends('admin.layouts.layout')

@section('styles')
    <!-- Sweet alert 2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.css') }}">
    <!-- Select 2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portalunimar/other/select2-boostrap.css') }}">
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/es.global.min.js"></script>
    <!-- Sweet alert 2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.js') }}"></script>
    <!-- Select 2 -->
    <script src="{{ asset('plugins/select2/js/select2.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/portalunimar/admin/reservation_calendar.css') }}">
@endsection

@section('admincontent')
    <form class="d-flex flex-column gap-2" id="reservation_form">
        <div>
            <label for="reservation_start">Hora de inicio</label>
            <input type="datetime-local" name="reservation_start" id= "reservation_start" />
        </div>
        <div>
            <label for="reservation_end">Hora de finalización</label>
            <input type="datetime-local" name="reservation_end" id= "reservation_end" />
        </div>
        <div>
            <label for="professor_name">Nombre del profesor</label>
            <input type="text" name="professor_name" id="professor_name" />
        </div>
        <div>
            <label for="professor_name">Correo del profesor</label>
            <input type="email" name="professor_email" id="professor_email" />
        </div>
        <div>
            <label for="classroom">Aula</label>
            <input type="text" name="classroom" id="classroom" />
        </div>
        <div>
            <label for="asignature">Asignatura</label>
            <input type="text" name="asignature" id="asignature" />
        </div>
        <div>
            <label for="video_beam_hdmi">Video Beam HDMI</label>
            <input type="checkbox" name="video_beam_hdmi" id="video_beam_hdmi" />
        </div>
        <div>
            <label for="video_beam_vga">Video Beam VGA</label>
            <input type="checkbox" name="video_beam_vga" id="video_beam_vga" />
        </div>
        <div>
            <label for="laptop">Laptop</label>
            <input type="checkbox" name="laptop" id="laptop" />
        </div>
        <div>
            <label for="electrical_extension">Extensión eléctrica</label>
            <input type="checkbox" name="electrical_extension" id="electrical_extension" />
        </div>
        <div>
            <label for="adapter">Adaptador</label>
            <input type="checkbox" name="adapter" id="adapter" />
        </div>
        <div>
            <button>Enviar</button>
        </div>
    </form>
    <div id="calendar"></div>
    <script>
        var calendar;
        $(document).ready(function() {
            // Recibir data del formulario
            let reservation = {
                professor_name: "",
                professor_email: "",
                classroom: "",
                asignature: "",
                video_beam_hdmi: false,
                video_beam_vga: false,
                laptop: false,
                electrical_extension: false,
                reservation_start: new Date().toISOString(),
                reservation_end: new Date().toISOString()
            }
            $('#professor_name').on("input", function(event) {
                reservation.professor_name = event.target.value
            })
            $('#professor_email').on("input", function(event) {
                reservation.professor_email = event.target.value
            })
            $('#classroom').on("input", function(event) {
                reservation.classroom = event.target.value
            })
            $('#asignature').on("input", function(event) {
                reservation.asignature = event.target.value
            })
            $('#video_beam_hdmi').on("input", function(event) {
                reservation.video_beam_hdmi = event.target.checked
            })
            $('#video_beam_vga').on("input", function(event) {
                reservation.video_beam_vga = event.target.checked
            })
            $('#laptop').on("input", function(event) {
                reservation.laptop = event.target.checked
            })
            $('#electrical_extension').on("input", function(event) {
                reservation.electrical_extension = event.target.checked
            })
            $('#adapter').on("input", function(event) {
                reservation.adapter = event.target.checked
            })
            $('#reservation_start').on("input", function(event) {
                reservation.reservation_start = event.target.value
                console.log(reservation);
            })
            $('#reservation_end').on("input", function(event) {
                reservation.reservation_end = event.target.value
                console.log(reservation);
            })
            let calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'Es',
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev next',
                    center: 'title',
                    right: 'dayGridMonth customWeek'
                },
                views: {
                    customWeek: {
                        type: 'timeGrid',
                        duration: {
                            days: 7
                        },
                        buttonText: 'Semana'
                    },
                    dayGridMonth: {
                        buttonText: 'Mes'
                    },
                },
                timeZone: "UTC",
                slotMinTime: '07:00:00',
                slotMaxTime: '23:45:00',
                // slotDuration: '00:30',
                slotDuration: '00:05:00', // intervalo pequeño para tener granularidad
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                },
                height: "auto",
                eventMinHeight: 25,
            });
            calendar.render();

            function loadReservations(r = 0) {
                calendar.removeAllEvents();
                fetch("http://localhost/Backend/public/api/reservation").then(function(result) {
                        return result.json();
                    })
                    .then(function(result) {
                        for (let i = 0; i < result.length; i++) {
                            calendar.addEvent({
                                id: result[i].id,
                                title: result[i].professor_name + " - " + result[i].asignature + " - " +
                                    result[i].classroom,
                                start: result[i].reservation_start,
                                end: result[i].reservation_end
                            });
                        }
                    })
                    .catch(function() {
                        if (r < 3) {
                            loadReservations(r + 1);
                        }
                    });
            }
            $('#reservation_form').on("submit", function(event) {
                event.preventDefault();
                console.log(reservation);
                fetch("http://localhost/Backend/public/api/reservation", {
                        method: "POST",
                        body: JSON.stringify(reservation),
                        headers: {
                            Accept: "application/json",
                            "Content-Type": "application/json",
                        }
                    }).then(loadReservations)
                    .catch(console.log);
            })
            loadReservations();
        });
    </script>
@endsection
