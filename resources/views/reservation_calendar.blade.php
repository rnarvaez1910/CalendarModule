@extends('admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="/Backend/public/plugins/sweetalert2/sweetalert2.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/Backend/public/css/portalunimar/other/select2-boostrap.css" />
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet' />
    <link href="/Backend/public/css/portalunimar/calendar.css" rel="stylesheet" />
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
    <div id="loader" class="position-fixed w-100 h-100" style="top: 0; left: 0; z-index: 9998; display: none;">
        <div class="position-fixed w-100 h-100 bg-black" style="top: 0; left: 0; opacity: 0.5;">
        </div>
        <div class="position-fixed text-white w-100 h-100 d-flex flex-column justify-content-center align-items-center"
            style="top: 0; left: 0;">
            <div class="d-flex justify-content-center align-items-center position-relative">
                <i class="fa-solid fa-circle-notch fa-3x animate-spin"></i>
            </div>
        </div>
    </div>
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
                @if ($isAdmin)
                    <button type="button" class="btn btn-outline-success" id="approve_reservation">
                        Aprobar reserva
                    </button>
                @endif
                <button type="button" class="btn btn-outline-primary" id="edit_reservation">
                    Editar reserva
                </button>
                @if ($isAdmin)
                    <button type="button" class="btn btn-outline-danger" id="decline_reservation">
                        Rechazar reserva
                    </button>
                @endif
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
                <label for="professors">Profesor</label>
                <select id="professors" name="professors" class="form-control" style="width: 100%"></select>
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
            <div id="assets"></div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-danger close-dropdown">Cancelar</button>
                <span class="flex-grow-1 flex-shrink-1"></span>
                <button class="btn btn-outline-primary">Guardar</button>
            </div>
        </form>
    </div>
    {{-- Formulario de reserva --}}
    <div id="calendar_colors" class="d-flex align-items-center gap-2">
        <span style="background-color: #EED202; width: 15px; height: 15px;" class="rounded-circle d-inline-block"></span>
        <span>En espera</span> | <span style="background-color: #A28F02; width: 15px; height: 15px;"
            class="rounded-circle d-inline-block"></span><span>En espera-Fecha
            pasada</span> | <span style="background-color: #28a745; width: 15px; height: 15px;"
            class="rounded-circle d-inline-block"></span><span>Aprobada</span> | <span
            style="background-color: #115321; width: 15px; height: 15px;"
            class="rounded-circle d-inline-block"></span><span>Aprobada-Fecha
            pasada</span> | <span style="background-color: #F52D00; width: 15px; height: 15px;"
            class="rounded-circle d-inline-block"></span><span>Rechazadada</span> | <span
            style="background-color: #661300; width: 15px; height: 15px;"
            class="rounded-circle d-inline-block"></span><span>Rechazada-Fecha
            pasada</span>
    </div>
    <div id="calendar"></div>
    <button id="reservation_data_provider"></button>
    <script>
        var isAdmin = @json($isAdmin);
    </script>
    <script src="/Backend/public/js/portalunimar/variables.js"></script>
    <script src="/Backend/public/js/portalunimar/calendar.js"></script>
@endsection
