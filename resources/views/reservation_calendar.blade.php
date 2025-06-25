@extends('admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="/Backend/public/plugins/sweetalert2/sweetalert2.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/Backend/public/css/portalunimar/other/select2-boostrap.css">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <style>
        .select2-container .select2-selection--single {
            height: auto !important;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/es.global.min.js"></script>
    <script src="/Backend/public/plugins/sweetalert2/sweetalert2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>
    <link rel="stylesheet" href="/Backend/public/css/portalunimar/admin/reservation_calendar.css">
@endsection

@section('admincontent')
    <div id="reservation_dropdown" class="p-2 border bg-white position-fixed rounded overflow-y-auto"
        style="display: none; max-height: 375px;">
        <div id="reservation_info" style="display: none;">
            <div id="reservation_name" class="fs-5">
                Profesor - Fecha
            </div>
            <div class="d-flex gap-2">
                <span>Profesor:</span>
                <span id="reservation_professor"></span>
            </div>
            <div class="d-flex gap-2">
                <span>Asignatura:</span>
                <span id="reservation_asignature"></span>
            </div>
            <div class="d-flex gap-2">
                <span>Aula:</span>
                <span id="reservation_classroom"></span>
            </div>
            <div class="d-flex gap-2">
                <span>Fecha inicio:</span>
                <span id="reservation_date_start"></span>
            </div>
            <div class="d-flex gap-2">
                <span>Fecha fin:</span>
                <span id="reservation_date_end"></span>
            </div>
            <div id="reservation_assets">
                {{-- aqui va el resultado de las iteraciones --}}
            </div>
            <button class="btn btn-outline-success">
                Aprobar reserva
            </button>
            <button class="btn btn-outline-primary">
                Editar reserva
            </button>
            <button class="btn btn-outline-danger">
                Eliminar reserva
            </button>
        </div>
        <form class="flex-column gap-2" id="reservation_form" style="display: none !important;">
            <div class="d-flex gap-2">
                <div class="flex-grow-1 flex-shrink-1">
                    <label class="form-label" for="reservation_start">Hora de inicio</label>
                    <input type="datetime-local" name="reservation_start" id= "reservation_start" class="form-control" />
                </div>
                <div class="flex-grow-1 flex-shrink-1">
                    <label class="form-label" for="reservation_end">Hora de finalización</label>
                    <input type="datetime-local" name="reservation_end" id= "reservation_end" class="form-control" />
                </div>
            </div>
            <div>
                <label class="form-label" for="professor_name">Nombre del profesor</label>
                <input type="text" name="professor_name" id="professor_name" class="form-control" />
            </div>
            <div class="d-flex gap-2">
                <div class="flex-grow-1 flex-shrink-1">
                    <label class="form-label" for="professor_name">Correo del profesor</label>
                    <input type="email" name="professor_email" id="professor_email" class="form-control" />
                </div>
                <div class="flex-grow-1 flex-shrink-1">
                    <label class="form-label" for="asignature">Asignatura</label>
                    <input type="text" name="asignature" id="asignature" class="form-control" />
                </div>
            </div>
            <div>
                <label for="classroom">Aula</label>
                <select id="classroom" name="classroom" class="form-control" style="width: 100%">
                    <option value="A01">
                        A01
                    </option>
                    <option value="A02">
                        A02
                    </option>
                    <option value="A03">
                        A03
                    </option>
                    <option value="A04">
                        A04
                    </option>
                    <option value="A05">
                        A05
                    </option>
                    <option value="A06">
                        A06
                    </option>
                    <option value="A07">
                        A07
                    </option>
                    <option value="A08">
                        A08
                    </option>
                    <option value="A09">
                        A09
                    </option>
                    <option value="A10">
                        A10
                    </option>
                    <option value="A11">
                        A11
                    </option>
                    <option value="A12">
                        A12
                    </option>
                    <option value="A13">
                        A13
                    </option>
                    <option value="A14">
                        A14
                    </option>
                    <option value="A15">
                        A15
                    </option>
                    <option value="A16">
                        A16
                    </option>
                    <option value="A17">
                        A17
                    </option>
                    <option value="A18">
                        A18
                    </option>
                    <option value="A19">
                        A19
                    </option>
                    <option value="A20">
                        A20
                    </option>
                    <option value="A21">
                        A21
                    </option>
                    <option value="A22">
                        A22
                    </option>
                    <option value="A23">
                        A23
                    </option>
                    <option value="A24">
                        A24
                    </option>
                    <option value="A25">
                        A25
                    </option>
                    <option value="A26">
                        A26
                    </option>
                    <option value="A27">
                        A27
                    </option>
                    <option value="A28">
                        A28
                    </option>
                    <option value="A29">
                        A29
                    </option>
                    <option value="A30">
                        A30
                    </option>
                    <option value="A31">
                        A31
                    </option>
                    <option value="A32">
                        A32
                    </option>
                    <option value="A33">
                        A33
                    </option>
                    <option value="A34">
                        A34
                    </option>
                    <option value="A35">
                        A35
                    </option>
                    <option value="A36">
                        A36
                    </option>
                    <option value="A37">
                        A37
                    </option>
                    <option value="A38">
                        A38
                    </option>
                    <option value="A39">
                        A39
                    </option>
                    <option value="A40">
                        A40
                    </option>
                    <option value="A41">
                        A41
                    </option>
                    <option value="A42">
                        A42
                    </option>
                    <option value="L01">
                        L01
                    </option>
                    <option value="L02">
                        L02
                    </option>
                    <option value="L03">
                        L03
                    </option>
                    <option value="L04">
                        L04
                    </option>
                    <option value="L06">
                        L06
                    </option>
                    <option value="SD">
                        SD
                    </option>
                    <option value="SE1">
                        SE1
                    </option>
                    <option value="SE2">
                        SE2
                    </option>
                </select>
            </div>
            <div id="assets">

            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-danger close-dropdown">Cancelar</button>
                <span class="flex-grow-1 flex-shrink-1"></span>
                <button class="btn btn-outline-primary">Enviar</button>
            </div>
        </form>
    </div>
    {{-- Formulario de reserva --}}
    <div id="calendar"></div>
    <script>
        let calendar;
        $(document).ready(function() {
            $('#classroom').select2({
                width: 'resolve'
            });

            let anchorElement;

            function setDropdownVisibility(target, show = false) {
                if (!show) {
                    $("#reservation_dropdown").fadeOut(150);
                    anchorElement = null;
                } else {
                    anchorElement = target;
                    $("#reservation_dropdown").fadeIn(150);
                    updateDropdownPosition();
                }
            }

            function updateDropdownPosition() {
                if (anchorElement) {
                    const dimesions = anchorElement.getBoundingClientRect();

                    $("#reservation_dropdown").css({
                        top: $(window).outerHeight() < dimesions.top + $(
                                "#reservation_dropdown").outerHeight() ?
                            dimesions.top - 5 - ((dimesions.top + $(
                                "#reservation_dropdown").outerHeight()) - $(window).outerHeight()) :
                            dimesions.top,
                        left: $(window).outerWidth() < dimesions.left + 5 + dimesions.width + $(
                                "#reservation_dropdown").outerWidth() ?
                            dimesions.left - 5 - $("#reservation_dropdown").outerWidth() : dimesions
                            .left +
                            dimesions
                            .width + 5,
                        zIndex: 100
                    });
                }
            }

            $(".close-dropdown").on("click", function(event) {
                setDropdownVisibility(null, false);
            });

            $(document).scroll(function() {
                if ($("#reservation_dropdown").is(":visible") && anchorElement) updateDropdownPosition();
            });

            // Recibir data del formulario
            let reservation = {
                professor_name: "",
                professor_email: "",
                classroom: "",
                asignature: "",
                video_beam: false,
                cable_hdmi: false,
                laptop: false,
                electrical_extension: false,
                adapter: false,
                reservation_start: undefined,
                reservation_end: undefined
            }

            function availableAssets() {
                if (reservation.reservation_start && reservation
                    .reservation_end) { // se valida si las fechas no vienen vacias

                    fetch(`/Backend/public/api/assets?start=${reservation.reservation_start}:00&end=${reservation.reservation_end}:00`, {
                            method: "GET",
                        })
                        .then(function(response) {
                            return response.json();
                        })
                        .then(function(result) {
                            $("#assets").empty(); // Limpiar los assets previos
                            for (let i = 0; i < result.length; i++) {
                                $("#assets").append(
                                    `<div><input type='checkbox' class='form-check-input' id='${result[i].id}' ${result[i].can_reserve ? 'onclick="return false"' : ''}></input><label class='form-check-label'>${result[i].name}</label></div>`
                                );
                            }

                        });
                }
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
            $('#reservation_start').on("input", function(event) {
                reservation.reservation_start = event.target.value
                availableAssets();
            })
            $('#reservation_end').on("input", function(event) {
                reservation.reservation_end = event.target.value
                availableAssets();
            })
            let calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'Es',
                themeSystem: 'bootstrap5',
                windowResize: function() {
                    setTimeout(() => {
                        if ($("#reservation_dropdown").is(":visible")) updateDropdownPosition();
                    }, 100);
                },
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev next prueba',
                    center: 'title',
                    right: 'dayGridMonth timeGridWeek timeGridDay'
                },
                views: {
                    dayGridMonth: {
                        buttonText: 'Mes'
                    },
                    timeGridWeek: {
                        buttonText: 'Semana'
                    },
                    timeGridDay: {
                        buttonText: 'Día'
                    },
                },
                eventClick: function(event) {
                    // cargar los valores al formulario
                    $("#reservation_start").val(event.event.extendedProps.reservation
                        .reservation_start);
                    $("#reservation_end").val(event.event.extendedProps.reservation
                        .reservation_end);
                    $("#professor_name").val(event.event.extendedProps.reservation.professor_name);
                    $("#professor_email").val(event.event.extendedProps.reservation
                        .professor_email);
                    $("#classroom").val(event.event.extendedProps.reservation.classroom);
                    $("#asignature").val(event.event.extendedProps.reservation.asignature);
                    $("#video_beam").val(event.event.extendedProps.reservation.video_beam);
                    $("#cable_hdmi").val(event.event.extendedProps.reservation.cable_hdmi);
                    $("#laptop").val(event.event.extendedProps.reservation.laptop);
                    $("#electrical_extension").val(event.event.extendedProps.reservation
                        .electrical_extension);
                    $("#adapter").val(event.event.extendedProps.reservation.adapter);

                    // cargar data al dropdown
                    const professorName = event.event.extendedProps.reservation
                        .professor_name;
                    const reservationDate = event.event.extendedProps.reservation
                        .reservation_start
                    const reservationCombined = `${professorName} - ${reservationDate}`;
                    $("#reservation_name").text(reservationCombined);
                    $("#reservation_professor").text(event.event.extendedProps.reservation
                        .professor_name);
                    $("#reservation_asignature").text(event.event.extendedProps.reservation
                        .asignature);
                    $("#reservation_classroom").text(event.event.extendedProps.reservation
                        .classroom);
                    $("#reservation_date_start").text(new Date(event.event.extendedProps.reservation
                        .reservation_start).toLocaleString(
                    "es-ES")); // usar esto para mejorar el formato de fecha
                    $("#reservation_date_end").text(event.event.extendedProps.reservation
                        .reservation_end);

                    $("#reservation_form").hide();
                    $("#reservation_info").show();
                    setDropdownVisibility(event.el, true);

                    $(document).on("click", ":not(#reservation_dropdown)", function() {
                        // $("#reservation_dropdown").hide();
                    });
                },
                hiddenDays: [0, 6], // Ocultar fines de semana
                timeZone: "UTC",
                slotMinTime: '07:00:00',
                slotMaxTime: '23:45:00',
                slotDuration: '00:05:00', // intervalo pequeño para tener granularidad
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                },
                customButtons: {
                    prueba: {
                        text: "Crear reserva",
                        click: function(event) {
                            $("#reservation_form").css('display', 'flex');;
                            $("#reservation_info").hide();
                            setDropdownVisibility(event.target, true)
                        }
                    }
                },
                height: "auto",
                eventMinHeight: 25,
            });
            calendar.render();

            function loadReservations(r = 0) {
                calendar.removeAllEvents();
                fetch("/Backend/public/api/reservation").then(function(result) {
                        return result.json();
                    })
                    .then(function(result) {
                        for (let i = 0; i < result.length; i++) {
                            calendar.addEvent({
                                id: result[i].id,
                                title: result[i].professor_name + " - " + result[i].asignature +
                                    " - " +
                                    result[i].classroom,
                                start: result[i].reservation_start,
                                end: result[i].reservation_end,
                                extendedProps: {
                                    reservation: result[i]
                                }
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
                fetch("/Backend/public/api/reservation", {
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
