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

        .fc-event {
            cursor: pointer;
        }

        .past-event,
        .past-event * {
            color: #001E64;
            border-color: #001E64;
        }

        #reservation_info table td {
            max-width: 150px;
            overflow-x: hidden;
            text-overflow: ellipsis;

        }

        #reservation_info table tr:not(:last-child) {
            border-bottom: 1px solid #1f2d3d;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/locale/es-mx.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/es.global.min.js"></script>
    <script src="/Backend/public/plugins/sweetalert2/sweetalert2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>
    <link rel="stylesheet" href="/Backend/public/css/portalunimar/admin/reservation_calendar.css">
@endsection

@section('admincontent')
    <button type="button" onclick="window.open('/Backend/public/api/reservation/report', '_blank');"></button>
    <div id="reservation_dropdown" class="p-2 border bg-white position-fixed rounded overflow-y-auto"
        style="display: none;">
        <div id="reservation_info" style="display: none;" class="flex-column gap-1">
            <div id="reservation_name" class="fs-5 text-center">
                Profesor - Fecha
            </div>
            <hr class="separator" />

            <table>
                <tr>
                    <td class="px-2 py-1">
                        Profesor:
                    </td>
                    <td class="px-2 py-1" id="reservation_professor"></td>
                    <td class="px-2 py-1">
                        Email:
                    </td>
                    <td class="px-2 py-1" id="reservation_email"></td>
                </tr>
                <tr>
                    <td class="px-2 py-1">
                        Asignatura:
                    </td>
                    <td class="px-2 py-1" id="reservation_asignature"></td>
                    <td class="px-2 py-1">
                        Aula:
                    </td>
                    <td class="px-2 py-1" id="reservation_classroom"></td>
                </tr>
                <tr>
                    <td class="px-2 py-1">
                        Fecha inicio:
                    </td>
                    <td class="px-2 py-1" id="reservation_date_start"></td>
                    <td class="px-2 py-1">
                        Fecha fin:
                    </td>
                    <td id="reservation_date_end"></td>
                </tr>
            </table>
            <div id="reservation_assets">
                {{-- aqui va el resultado de las iteraciones --}}
            </div>
            <div class="d-flex gap-2 align-items-center justify-content-center">
                <button type="button" class="btn btn-outline-success">
                    Aprobar reserva
                </button>
                <button type="button" class="btn btn-outline-primary" id="edit_reservation">
                    Editar reserva
                </button>
                <button type="button" class="btn btn-outline-danger" id="delete_reservation">
                    Eliminar reserva
                </button>
            </div>
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
            <div>
                <label class="form-label" for="professor_name">Correo del profesor</label>
                <input type="email" name="professor_email" id="professor_email" class="form-control" />
            </div>
            <div class="d-flex gap-2">
                <div class="flex-grow-1 flex-shrink-1">
                    <label class="form-label" for="asignature">Asignatura</label>
                    <input type="text" name="asignature" id="asignature" class="form-control" />
                </div>
                <div class="flex-grow-1 flex-shrink-1">
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
            </div>
            <div id="assets">

            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-danger close-dropdown">Cancelar</button>
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
            let assets = [];

            const DEFAULT_VALUES = {
                id: undefined,
                professor_name: "",
                professor_email: "",
                classroom: "A01",
                asignature: "",
                assets_reservation: [],
                reservation_start: undefined,
                reservation_end: undefined
            };

            let reservation = {
                ...DEFAULT_VALUES
            };

            function setDropdownVisibility(target, show = false) {
                if (!show) {
                    $("#reservation_dropdown").fadeOut(150);
                    $(document).off("click", hideDropdownOnClickOutside);
                    anchorElement = null;

                    $("#reservation_start").val("");
                    $("#reservation_end").val("");
                    $("#professor_name").val("");
                    $("#professor_email").val("");
                    $("#classroom").val("");
                    $("#asignature").val("");

                    reservation = {
                        ...DEFAULT_VALUES
                    };
                } else {
                    anchorElement = target;
                    $("#reservation_dropdown").fadeIn(150);
                    setTimeout(function() {
                        $(document).on("click", hideDropdownOnClickOutside);
                    }, 100);
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
                if ($("#reservation_dropdown").is(":visible") && anchorElement)
                    updateDropdownPosition();
            });

            $(document).on("input", ".asset-input", function(event) {
                const assetId = event.target.id;
                if (event.target.checked) {
                    reservation.assets_reservation = reservation.assets || [];
                    reservation.assets_reservation.push(assetId);
                } else {
                    reservation.assets_reservation = reservation.assets_reservation.filter((id) =>
                        id !== assetId);
                }

                console.log(reservation)
            });

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
                                    `<div class='form-check d-flex align-items-center gap-2 p-0 m-0'><input type='checkbox' class='form-check-input asset-input m-0 float-none position-relative' id='${result[i].id}' ${!result[i].can_reserve ? 'onclick="return false"' : ''}></input><label for='${result[i].id}' class='form-check-label'>${result[i].name}</label></div>`
                                );
                            }

                        });
                }
            }

            function hideDropdownOnClickOutside(event) {
                if (!event.target.closest("#reservation_dropdown"))
                    setDropdownVisibility(null, false);

            }

            $('#professor_name').on("input", function(event) {
                reservation.professor_name = event.target.value
            });

            $('#professor_email').on("input", function(event) {
                reservation.professor_email = event.target.value
            });

            $('#classroom').on("input", function(event) {
                reservation.classroom = event.target.value
            });

            $('#asignature').on("input", function(event) {
                reservation.asignature = event.target.value
            });

            $('#reservation_start').on("input", function(event) {
                reservation.reservation_start = event.target.value
                availableAssets();
            });

            $('#reservation_end').on("input", function(event) {
                reservation.reservation_end = event.target.value
                availableAssets();
            });

            let calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(
                calendarEl, {
                    locale: 'Es',
                    themeSystem: 'bootstrap5',
                    windowResize: function() {
                        setTimeout(function() {
                            if ($("#reservation_dropdown").is(":visible"))
                                updateDropdownPosition();
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
                        $("#reservation_start").val(moment(event.event.extendedProps.reservation
                            .reservation_start).utc().format('YYYY-MM-DDTHH:mm'));
                        $("#reservation_end").val(moment(event.event.extendedProps.reservation
                            .reservation_end).utc().format('YYYY-MM-DDTHH:mm'));
                        $("#professor_name").val(event.event.extendedProps.reservation
                            .professor_name);
                        $("#professor_email").val(event.event.extendedProps.reservation
                            .professor_email);
                        $("#classroom").val(event.event.extendedProps.reservation.classroom);
                        $("#asignature").val(event.event.extendedProps.reservation.asignature);

                        // cargar data al dropdown
                        const professorName = event.event.extendedProps.reservation
                            .professor_name;
                        const reservationDate = moment(event.event.extendedProps.reservation
                            .reservation_start).utc().format('DD/MM/YYYY');
                        const reservationCombined = `${professorName} - ${reservationDate}`;

                        reservation = {
                            ...event.event.extendedProps.reservation,
                            assets_reservation: event.event.extendedProps.reservation.assets_reservation
                                .map(function(asset) {
                                    return asset.id;
                                })
                        };

                        $("#reservation_name").text(reservationCombined);
                        $("#reservation_professor").text(event.event.extendedProps.reservation
                            .professor_name);
                        $("#reservation_email").text(event.event.extendedProps.reservation
                            .professor_email);
                        $("#reservation_asignature").text(event.event.extendedProps.reservation
                            .asignature);
                        $("#reservation_classroom").text(event.event.extendedProps.reservation
                            .classroom);
                        $("#reservation_date_start").text(moment(event.event.extendedProps
                            .reservation
                            .reservation_start).utc().format('DD/MM/YYYY HH:mm'));
                        $("#reservation_date_end").text(moment(event.event.extendedProps
                            .reservation
                            .reservation_end).utc().format('DD/MM/YYYY HH:mm'));

                        console.log(reservation);
                        console.log(assets);
                        assets.forEach(function(asset) {
                            $("#" + asset.id).prop("checked", reservation.assets_reservation
                                .includes(asset.id));
                        });

                        $("#reservation_form").hide();
                        $("#reservation_info").css('display', 'flex');;

                        if (!$("#reservation_dropdown").is(":visible")) {
                            setDropdownVisibility(event.el, true);
                        } else {
                            anchorElement = event.el;
                            updateDropdownPosition();
                        }
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
                    eventDidMount: function(event) {
                        const today = moment(new Date().toISOString()).utc();
                        const eventEnd = event.event.end || event.event.start;
                        if (moment().utc().isAfter(eventEnd)) event.el.classList.add("past-event");
                    },
                });
            calendar.render();

            const navbar = document.querySelector(
                "aside.main-sidebar.sidebar-light-primary.elevation-4");
            const ro = new ResizeObserver(function(entries) {
                calendar.updateSize();
            });

            ro.observe(navbar);

            function loadReservations(r = 0) {
                calendar.removeAllEvents();
                fetch("/Backend/public/api/reservation").then(function(result) {
                        return result.json();
                    })
                    .then(function(result) {
                        for (let i = 0; i < result.length; i++) {
                            calendar.addEvent({
                                id: result[i].id,
                                title: result[i].professor_name + " - " + result[i]
                                    .asignature +
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
                        if (r < 3) loadReservations(r + 1);
                    });
            }

            function loadAssets() {
                fetch("/Backend/public/api/assets").then(function(result) {
                        return result.json();
                    })
                    .then(function(result) {
                        assets = result;
                        $("#assets").empty(); // Limpiar los assets previos
                        for (let i = 0; i < result.length; i++) {
                            $("#assets").append(
                                `<div class='form-check d-flex align-items-center gap-2 p-0 m-0'><input type='checkbox' class='form-check-input asset-input m-0 float-none position-relative' id='${result[i].id}' ${!result[i].can_reserve ? 'onclick="return false"' : ''}></input><label for='${result[i].id}' class='form-check-label'>${result[i].name}</label></div>`
                            );
                        }
                    });
            }

            $("#edit_reservation").click(function() {
                $("#reservation_info").hide();
                $("#reservation_form").css('display', 'flex');;
                updateDropdownPosition();
            });

            $("#delete_reservation").click(function() {
                Swal.fire({
                        "title": "¿Desea continuar?",
                        "text": "Esta acción eliminará la reserva y no se podrá deshacer.",
                        "icon": "warning",
                        "showCancelButton": true,
                        "confirmButtonText": "Sí, eliminar",
                        "confirmButtonColor": "#dc3545",
                        "cancelButtonText": "Cancelar",
                    }).then(function(result) {
                        if (result.isConfirmed) return fetch("/Backend/public/api/reservation/" +
                            reservation.id, {
                                method: "DELETE",
                            });
                    }).then(function(result) {
                        if (!result) return;

                        setDropdownVisibility(null, false);
                        loadReservations();
                    })
                    .catch(console.log);

            });

            $('#reservation_form').on("submit", function(event) {
                event.preventDefault();
                console.log(reservation);
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
            loadAssets();
        });
    </script>
@endsection
