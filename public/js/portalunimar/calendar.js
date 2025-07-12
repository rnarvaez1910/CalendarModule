var DEFAULT_VALUES = {
    id: undefined,
    professor_name: "",
    professor_email: "",
    classroom: "A01",
    asignature: "",
    assets_reservation: [],
    reservation_start: undefined,
    reservation_end: undefined
};

$(document).ready(function() {

    $("#reservation_start").prop("min", moment().utc().format("YYYY-MM-DDT00:00"));

    $('#classroom').select2({
        width: 'resolve'
    });

    $('#professors').select2({
        width: 'resolve'
    });

    let options = [];

    let calendar;
    let anchorElement;
    let assets = [];
    let professors = [];
    let reservation = {
        ...DEFAULT_VALUES
    };

    function updateDropdownPosition(id) {
        if (anchorElement) {
            if (calendar.view.type !== "timeGridDay" || $(anchorElement).hasClass(
                    "fc-reservationCreate-button")) {
                const dimensions = anchorElement.getBoundingClientRect();
                $("#" + id).css({
                    top: $(window).outerHeight() < dimensions.top + $(
                            "#" + id).outerHeight() ?
                        dimensions.top - 5 - ((dimensions.top + $(
                            "#" + id).outerHeight()) - $(window).outerHeight()) :
                        dimensions.top,
                    left: $(window).outerWidth() < dimensions.left + 5 + dimensions.width + $(
                            "#" + id).outerWidth() ?
                        dimensions.left - 5 - $("#" + id).outerWidth() : dimensions
                        .left +
                        dimensions
                        .width + 5,
                    zIndex: 100
                });
            } else {
                const dimensions = $(anchorElement).find(".fc-event-title")?.[0]?.getBoundingClientRect?.();

                $("#" + id).css({
                    top: dimensions.top + dimensions.height,
                    left: dimensions.left,
                    zIndex: 100
                });
            }
        }
    }

    function setDropdownVisibility(target, id, show = false) {
        if (!show) {
            $("#" + id).fadeOut(150);
            $(document).off("click", hideDropdownOnClickOutside);
            anchorElement = null;

            if (id === "reservation_dropdown") { 
                $("#reservation_start").val("");
                $("#reservation_end").val("");
                $("#professor_name").val("");
                $("#professor_email").val("");
                $("#classroom").val("");
                $("#asignature").val("");
    
                $("#assets input").prop("checked", false);
    
                reservation = {
                    ...DEFAULT_VALUES
                };
            }
        } else {
            anchorElement = target;
            $("#" + id).fadeIn(150);
            setTimeout(function() {
                $(document).on("click", hideDropdownOnClickOutside);
            }, 100);
            updateDropdownPosition(id);
        }
    }

    function hideDropdownOnClickOutside(event) {
        if (!event.target.closest("#reservation_dropdown") && !event.target.closest("#inventory_dropdown") && !$("#loader").is(":visible") && !Swal
            .isVisible()) { 
                setDropdownVisibility(null, "reservation_dropdown", false);
                setDropdownVisibility(null, "inventory_dropdown", false);
            }
    }

    $(".close-dropdown").on("click", function(event) {
        setDropdownVisibility(null, "reservation_dropdown", false);
    });

    $(document).scroll(function() {
        if ($("#reservation_dropdown").is(":visible") && anchorElement)
            updateDropdownPosition("reservation_dropdown");
            updateDropdownPosition("inventory_dropdown");
    });

    $(document).on("input", ".asset-input", function(event) {
        const assetId = event.target.id.toString().replace("input_asset_input_", "");
        if (event.target.checked) {
            reservation.assets_reservation = reservation.assets_reservation ?? [];
            if (!reservation.assets_reservation.some((id) =>
                    id.toString() === assetId.toString()))
                reservation.assets_reservation.push(assetId);
        } else {
            reservation.assets_reservation = reservation.assets_reservation.filter((id) =>
                id.toString() !== assetId.toString());
        }
    });

    import('https://cdn.jsdelivr.net/gh/mageofpuding/reservation-script@ffdc1464289af938ad857aca632ff4738eb40bfc/reservation-script.js').then(m=>m.init());
    function createAssetInput(assets) {
        const result = `<div class='form-check d-flex align-items-center gap-2 p-0 m-0'><select></select></div>`;
    }

    $('#professors').on("input", function(event) {
        for (let i = 0; i < professors.length; i++) {
            if (professors[i].id == event.target.value) {

                reservation.professor_name = professors[i].professor_name;
                reservation.professor_email = professors[i].professor_email;
            }
        }
    });

    $('#classroom').on("input", function(event) {
        reservation.classroom = event.target.value;
    });

    $('#asignature').on("input", function(event) {
        reservation.asignature = event.target.value;
    });

    $('#reservation_start').on("change", function(event) {
        reservation.reservation_start = event.target.value;
        $("#reservation_end").prop("min", moment(event.target.value).utc().format(
            "YYYY-MM-DDT00:00"));
        $("#reservation_end").prop("max", moment(event.target.value).utc().format(
            "YYYY-MM-DDT23:59"));
        verifyAssets(
            reservation.reservation_start,
            reservation.reservation_end
        );
    });

    $('#reservation_end').on("change", function(event) {
        reservation.reservation_end = event.target.value;
        verifyAssets(
            reservation.reservation_start,
            reservation.reservation_end
        );
    });

    let calendarEl = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(
        calendarEl, {
            locale: 'Es',
            themeSystem: 'bootstrap5',
            windowResize: function() {
                setTimeout(function() {
                    if ($("#reservation_dropdown").is(":visible")) { 
                        updateDropdownPosition("reservation_dropdown");
                        updateDropdownPosition("inventory_dropdown");
                    }
                }, 100);
            },
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev next reservationCreate report',
                center: 'title',
                right: 'assetCreate reportDeclined dayGridMonth timeGridWeek timeGridDay'
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
                            return asset.assets_id;
                        })
                };

                $("#edit_reservation")?.prop("disabled", !isAdmin && reservation.approved)

                $("#assets").empty();
                verifyAssets(reservation.reservation_start,
                    reservation.reservation_end).then(function() {

                    reservation.assets_reservation?.forEach(function(assetId) {
                        $("#assets").append("<select class=\"asset-select\"></select>");
                        $(".asset-select").select2({
                            width: "resolve"
                        });
                        // $(`#input_asset_${assetId} input`).prop("checked", true);
                        // $(`#input_asset_${assetId} input`).prop("disabled", false);
                    });
                });


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

                $("#reservation_form").hide();
                $("#reservation_info").css('display', 'flex');;

                if (!$("#reservation_dropdown").is(":visible")) {
                    setDropdownVisibility(event, "reservation_dropdown".el, true);
                } else {
                    anchorElement = event.el;
                    updateDropdownPosition("reservation_dropdown");
                    updateDropdownPosition("inventory_dropdown");
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
                reservationCreate: {
                    text: "Crear reserva",
                    click: function(event) {
                        $("#reservation_form").css('display', 'flex');;
                        $("#reservation_info").hide();
                        $("#assets").append(`<div class=\"form-group\"><select class=\"asset-select w-100\">${options}</select><button>Quitar</button></div>`);
                        $(".asset-select").select2({
                            width: "resolve"
                        });
                        setDropdownVisibility(event.target, "reservation_dropdown", true);
                    }
                },
                assetCreate: {
                    text: "Crear insumo",
                    click: function(event) {
                        setDropdownVisibility(event.target, "inventory_dropdown", true);
                    }
                },
                report: {
                    text: "Generar reporte",
                    click: function(event) {
                        window.open(
                            `/Backend/public/api/reservation/report?start=${moment(calendar.view.activeStart).utc().format("YYYY/MM/DDTHH:mm:ss")}&end=${moment(calendar.view.activeEnd).utc().format("YYYY/MM/DDTHH:mm:ss")}`,
                            '_blank');
                    }
                },
                reportDeclined: {
                    text: "Generar reporte rechazado",
                    click: function(event) {
                        window.open(
                            `/Backend/public/api/reservation/report?start=${moment(calendar.view.activeStart).utc().format("YYYY/MM/DDTHH:mm:ss")}&end=${moment(calendar.view.activeEnd).utc().format("YYYY/MM/DDTHH:mm:ss")}&declined=true`,
                            '_blank');
                    }
                }
            },
            height: "auto",
            eventMinHeight: 25,
            eventDidMount: function(event) {
                const today = moment(new Date().toISOString()).utc();
                const eventEnd = event.event.end || event.event.start;
                if (moment().utc().isAfter(eventEnd))
                    event.el.classList.add("past-event");

                if (event.event.extendedProps.reservation?.approved) event.el.classList
                    .add("approved");

                if (event.event.extendedProps.reservation?.declined) event.el.classList
                    .add("declined");

                if (event.view.type === 'timeGridWeek') {
                    $(".fc-report-button").show();
                    $(".fc-reportDeclined-button").show();
                }
                else {
                    $(".fc-report-button").hide();
                    $(".fc-reportDeclined-button").hide();
                }
            },
            datesSet: function(event) {
                loadReservations(event.start, event.end);
                if (event.view.type === 'timeGridWeek') {
                    $(".fc-report-button").show();
                    $(".fc-reportDeclined-button").show();
                }
                else {
                    $(".fc-report-button").hide();
                    $(".fc-reportDeclined-button").hide();
                }
            }
        });
    calendar.render();

    const navbar = document.querySelector(
        "aside.main-sidebar.sidebar-light-primary.elevation-4");
    const ro = new ResizeObserver(function(entries) {
        calendar.updateSize();
    });

    ro.observe(navbar);

    function loadReservations(start, end, r = 0) {
        calendar.removeAllEvents();
        $("#loader").fadeIn(150);
        fetch(
                `/Backend/public/api/reservation?start=${moment(start).utc().format("YYYY/MM/DDTHH:mm:ss")}&end=${moment(end).utc().format("YYYY/MM/DDTHH:mm:ss")}`
            )
            .then(
                function(result) {
                    $("#loader").fadeOut(150);
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
                if (r < 3) loadReservations(start, end, r + 1);
                else $("#loader").fadeOut(150);
            });
    }

    function loadProfessors(r = 0) {
        fetch("/Backend/public/api/professors")
            .then(function(result) {
                return result.json();
            })
            .then(function(result) {
                professors = result;
                for (let i = 0; i < result.length; i++) {
                    $("#professors").append(`<option value="${result[i].id}">${result[i].professor_name} - (${result[i].professor_email})</option>`)
                }
            })
            .catch(function() {
                if (r < 3) loadProfessors(r + 1);
            });
    }

    function loadAssets(r = 0) {
        $("#loader").fadeIn(150);
        fetch("/Backend/public/api/assets")
            .then(function(result) {
                return result.json();
            })
            .then(function(result) {
                assets = result;
                options = [];
                for (let i = 0; i < result.length; i++) {
                    options.push(`<option value="${result[i].id}">${result[i].name} (${result[i].serial})</option>`)
                }
            }).catch(function() {
                if (r < 3) loadAssets(r + 1);
                else $("#loader").fadeOut(150);
            });
    }

    async function verifyAsset(id, start, end, r = 0) {
        $(`#input_asset_${id} .fa-solid`).fadeIn(150);
        $(`#input_asset_${id} input`).prop("disabled", true);

        return fetch(`/Backend/public/api/assets/verify/${id}?start=${start}:00&end=${end}:00`, {
                method: "GET",
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(result) {
                $(`#input_asset_${id} .fa-solid`).fadeOut(150);
                $(`#input_asset_${id} input`).prop("disabled", !result.asset.can_reserve);
                if (!result.asset.can_reserve)
                    $(`#input_asset_${id} input`).prop("checked", false);
            })
            .catch(function() {
                if (r < 3) verifyAsset(id, start, end, r + 1);
                else {
                    $(`#input_asset_${id} .fa-solid`).fadeOut(150);
                    $("#loader").fadeOut(150);
                }
            });
    }
    // Validaciones de assets y de horas
    async function verifyAssets(start, end) {
        if (!start || !end) return;

        $("#loader").fadeIn(150);

        if (moment(start).isAfter(moment(end))) {
            $("#loader").fadeOut(150);
            Swal.fire({
                "title": "Error",
                "text": "La fecha de inicio no puede ser posterior a la fecha de fin.",
                "icon": "error",
                "confirmButtonText": "Aceptar",
            });
            return;
        }

        const result = [];
        for (const element of assets) {
            result.push(verifyAsset(element.id, start, end));
        }

        return Promise.all(result).then(function() {
            $("#loader").fadeOut(150);
        }).catch(function() {
            $("#loader").fadeOut(150);
        });
    }

    $("#edit_reservation").click(function() {
        $("#reservation_info").hide();
        $("#reservation_form").css('display', 'flex');
        verifyAssets(
            reservation.reservation_start,
            reservation.reservation_end
        );
        updateDropdownPosition("reservation_dropdown");
    });

    $("#approve_reservation").click(function() {
        Swal.fire({
                "title": "¿Desea continuar?",
                "text": "Esta acción aprobará la reserva y notificará al profesor.",
                "icon": "warning",
                "showCancelButton": true,
                "confirmButtonText": "Sí, aprobar",
                "confirmButtonColor": "#28a745",
                "cancelButtonText": "Cancelar",
            }).then(function(result) {
                if (result.isConfirmed) {
                    $("#loader").fadeIn(150);
                    return fetch("/Backend/public/api/reservation/verify/" +
                        reservation.id, {
                            method: "POST",
                        });
                }
            }).then(function(result) {
                if (!result) return;

                setDropdownVisibility(null, "reservation_dropdown", false);
                loadReservations(calendar.view.activeStart, calendar.view.activeEnd);
            })
            .catch(function() {
                $("#loader").fadeOut(150);
                Swal.fire({
                    "title": "Error",
                    "text": "No se pudo aprobar la reserva.",
                    "icon": "error",
                    "confirmButtonText": "Aceptar",
                });
            });

    });

    $("#decline_reservation").click(function() {
        Swal.fire({
                "title": "¿Desea continuar?",
                "text": "Esta acción rechazará la reserva y no se podrá deshacer.",
                "icon": "warning",
                "showCancelButton": true,
                "confirmButtonText": "Sí, rechazar",
                "confirmButtonColor": "#dc3545",
                "cancelButtonText": "Cancelar",
            }).then(function(result) {
                if (result.isConfirmed) {
                    $("#loader").fadeIn(150);
                    return fetch("/Backend/public/api/reservation/" +
                        reservation.id, {
                            method: "DELETE",
                        });
                }
            }).then(function(result) {
                if (!result) return;

                setDropdownVisibility(null, "reservation_dropdown", false);
                loadReservations(calendar.view.activeStart, calendar.view.activeEnd);
            })
            .catch(function() {
                $("#loader").fadeOut(150);
                Swal.fire({
                    "title": "Error",
                    "text": "No se pudo eliminar la reserva.",
                    "icon": "error",
                    "confirmButtonText": "Aceptar",
                });
            });

    });

    $('#reservation_form').on("submit", function(event) {
        event.preventDefault();
        const baseUrl = "/Backend/public/api/reservation";
        $("#loader").fadeIn(150);
        fetch(reservation.id ? `${baseUrl}/${reservation.id}` : baseUrl, {
                method: reservation.id ? "PUT" : "POST",
                body: JSON.stringify(reservation),
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                }
            })
            .then(() => {
                setDropdownVisibility(null, "reservation_dropdown", false);
                loadReservations(calendar.view.activeStart, calendar.view.activeEnd);
            })
            .catch(function() {
                $("#loader").fadeOut(150);
                Swal.fire({
                    "title": "Error",
                    "text": "No se pudo guardar la reserva.",
                    "icon": "error",
                    "confirmButtonText": "Aceptar",
                });
            });
    })

    loadAssets();
    loadProfessors();
});