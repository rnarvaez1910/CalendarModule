@extends('admin.layouts.layout')

@section('styles')
  <style>
    .fc-col-header-cell-cushion,
    .fc-toolbar-title,
    .fc-daygrid-day-number {
    text-transform: capitalize !important;
    }

    .modal-bg {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.3);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    }

    .modal-bg.active {
    display: flex;
    }

    .modal-content {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    min-width: 320px;
    max-width: 90vw;
    position: relative;
    }

    .close-btn {
    position: absolute;
    right: 1rem;
    top: 1rem;
    background: none;
    border: none;
    font-size: 1.4rem;
    cursor: pointer;
    }

    .d-flex {
    display: flex;
    }

    .flex-column {
    flex-direction: column;
    }

    .gap-2 {
    gap: .5rem;
    }

    input[type="number"] {
    text-align: center;
    }

    .form-checks {
    display: flex;
    gap: 1rem;
    align-items: center;
    }

    label {
    margin-right: 0.4rem;
    }

    button[type="submit"] {
    margin-top: 1rem;
    width: 100%;
    }

    .error-msg {
    color: red;
    font-size: 0.95em;
    margin: 0.3em 0;
    }
  </style>
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

@section ('admincontent')
  <script>
    var calendar;
    // logica del modal
    function abrirModal(date, startHour, startMinute, endHour, endMinute) {
    document.getElementById('modalReserva').classList.add('active');
    if (date) document.getElementById('fechaReserva').value = date;
    if (typeof startHour === 'number') document.getElementById('horaInicio').value = startHour;
    if (typeof startMinute === 'number') document.getElementById('minutoInicio').value = startMinute;
    if (typeof endHour === 'number') document.getElementById('horaFin').value = endHour;
    if (typeof endMinute === 'number') document.getElementById('minutoFin').value = endMinute;
    document.getElementById('errorMsg').innerText = '';
    }
    function cerrarModal() {
    document.getElementById('modalReserva').classList.remove('active');
    document.getElementById('formReserva').reset();
    document.getElementById('errorMsg').innerText = '';
    }
    document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('modalReserva').addEventListener('click', function (e) {
      if (e.target === this) cerrarModal();
    });
    // logica del calendario
    var calendarEl = document.getElementById('calendar');
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
        duration: { days: 7 },
        buttonText: 'Semana'
      },
      dayGridMonth: {
        buttonText: 'Mes'
      },
      },
      dateClick: function (info) {
      if (info.view.type === "customWeek") {
        // abrir modal con fecha y hora sugeridas
        let date = info.date;
        let year = date.getFullYear();
        let month = (date.getMonth() + 1).toString().padStart(2, '0');
        let day = date.getDate().toString().padStart(2, '0');
        let hours = date.getHours();
        let minutes = date.getMinutes();
        let end = new Date(date.getTime() + 45 * 60000); // Sugerencia: 45 min
        abrirModal(`${year}-${month}-${day}`, hours, minutes, end.getHours(), end.getMinutes());
      } else if (info.view.type === "dayGridMonth") {
        // Cambia la vista a customWeek empezando en el lunes correspondiente al día seleccionado
        var date = new Date(info.date);
        var day = date.getDay(); // 0=domingo, 1=lunes,...,6=sábado
        var diff = (day === 0 ? -6 : 1 - day); // Si es domingo, retrocede 6 días, si no, retrocede hasta lunes
        date.setDate(date.getDate() + diff);
        var mondayStr = date.toISOString().split('T')[0];
        calendar.changeView('customWeek', mondayStr);
      }
      },
      slotMinTime: '07:00:00',
      slotMaxTime: '23:45:00',
      // slotDuration: '00:30',
      slotDuration: '00:05:00', // intervalo pequeño para tener granularidad
      slotLabelFormat: { hour: '2-digit', minute: '2-digit', hour12: true },
      height: "auto",
      eventMinHeight: 25,
    });
    calendar.render();
    });
    var a = 0;
    // abre modal vacío con fecha de hoy
    function botonCrear() {
    let hoy = new Date();
    let year = hoy.getFullYear();
    let month = (hoy.getMonth() + 1).toString().padStart(2, '0');
    let day = hoy.getDate().toString().padStart(2, '0');
    abrirModal(`${year}-${month}-${day}`);
    }

    // Envio y validacion del formulario
    function enviarReserva(e) {
    e.preventDefault();
    const fecha = document.getElementById('fechaReserva').value;
    const teacherName = document.getElementById('profesor').value;
    const classroom = document.getElementById('aula').value;
    const hi = parseInt(document.getElementById('horaInicio').value, 10);
    const mi = parseInt(document.getElementById('minutoInicio').value, 10);
    const hf = parseInt(document.getElementById('horaFin').value, 10);
    const mf = parseInt(document.getElementById('minutoFin').value, 10);
    if (!fecha || isNaN(hi) || isNaN(mi) || isNaN(hf) || isNaN(mf)) {
      document.getElementById('errorMsg').innerText = 'Completa todos los campos de horario.';
      return;
    }
    // Valida rango horario
    const start = new Date(`${fecha}T${hi.toString().padStart(2, '0')}:${mi.toString().padStart(2, '0')}:00`);
    const end = new Date(`${fecha}T${hf.toString().padStart(2, '0')}:${mf.toString().padStart(2, '0')}:00`);
    if (end <= start) {
      document.getElementById('errorMsg').innerText = 'La hora de fin debe ser posterior a la de inicio.';
      return;
    }
    if (start.getDate() !== end.getDate() || start.getMonth() !== end.getMonth() || start.getFullYear() !== end.getFullYear()) {
      document.getElementById('errorMsg').innerText = 'La reserva debe ser en un mismo día.';
      return;
    }
    // titulo dinamico
    let titulo = 'Reserva';
    if (document.getElementById('videobeam').checked) titulo += ' + VideoBeam';
    if (document.getElementById('laptop').checked) titulo += ' + Laptop';
    if (document.getElementById('extension').checked) titulo += ' + Extensión';
    if (document.getElementById('adaptador').checked) titulo += ' + Adaptador';

    calendar.addEvent({
      id: 'a' + a,
      title: titulo,
      start: start.toISOString(),
      end: end.toISOString(),
      allDay: false
    });
    a++;
    const data = {
      fecha: document.getElementById('fechaReserva').value,
      profesor: document.getElementById('profesor').value,
      hora_inicio: horaInicio24h + ':' + minutoInicioPad,   // 'HH:MM'
      hora_fin: horaFin24h + ':' + minutoFinPad,           // 'HH:MM'
      aula: document.getElementById('aula').value || null,
      aula_especial: document.getElementById('aulaEspecial').value || null,
      videobeam: document.getElementById('videobeam').checked ? 1 : 0,
      laptop: document.getElementById('laptop').checked ? 1 : 0,
      extension: document.getElementById('extension').checked ? 1 : 0,
      adaptador: document.getElementById('adaptador').checked ? 1 : 0,
    };

    fetch('/reservations', {
      method: 'POST',
      headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify(data)
    })
      .then(res => res.json())
      .then(res => {
      if (res.success) {
        alert('Reserva creada exitosamente');
        cerrarModal();
      } else {
        alert('Error al guardar la reserva');
      }
      });
    cerrarModal();
    }
  </script>
  <button onclick="botonCrear()">Crear nueva reserva</button>
  <!-- modal -->
  <div class="modal-bg" id="modalReserva">
    <div class="modal-content">
    <button class="close-btn" onclick="cerrarModal()">&times;</button>
    <form class="d-flex flex-column gap-2" id="formReserva" onsubmit="enviarReserva(event)">
      <div class="d-flex gap-2">
      <div>
        <label for="fechaReserva">Fecha de la reserva</label>
        <input id="fechaReserva" name="fechaReserva" type="date" required style="width: 150px;" />
      </div>
      <input id="horaInicio" style="width:3rem;" type="number" min="0" max="12" maxlength="2" required
        placeholder="hh"
        oninput="if(this.value.length>2)this.value=this.value.slice(0,0);if(this.value<1)this.value=0;if(this.value>12)this.value=12;" />
      <span>:</span>
      <input id="minutoInicio" style="width:3rem;" type="number" min="0" max="59" maxlength="2" required
        placeholder="mm"
        oninput="if(this.value.length>2)this.value=this.value.slice(0,2);if(this.value<0)this.value=0;if(this.value>59)this.value=59;" />
      <select id="ampmInicio" required>
        <option value="AM">AM</option>
        <option value="PM">PM</option>
      </select>
      <span>-</span>
      <input id="horaFin" style="width:3rem;" type="number" min="0" max="12" maxlength="2" required placeholder="hh"
        oninput="if(this.value.length>2)this.value=this.value.slice(0,2);if(this.value<0)this.value=1;if(this.value>12)this.value=12;" />
      <span>:</span>
      <input id="minutoFin" style="width:3rem;" type="number" min="0" max="59" maxlength="2" required placeholder="mm"
        oninput="if(this.value.length>2)this.value=this.value.slice(0,2);if(this.value<0)this.value=0;if(this.value>59)this.value=59;" />
      <select id="ampmFin" required>
        <option value="AM">AM</option>
        <option value="PM">PM</option>
      </select>
      </div>
      <div class="form-checks">
      <label>VideoBeam</label>
      <input type="checkbox" id="videobeam" />
      </div>
      <div class="form-checks">
      <label>Laptop</label>
      <input type="checkbox" id="laptop" />
      </div>
      <div class="form-checks">
      <label>Extensión Eléctrica</label>
      <input type="checkbox" id="extension" />
      </div>
      <div class="form-checks">
      <label>Adaptador</label>
      <input type="checkbox" id="adaptador" />
      <div>
        <label for="profesor">Nombre del Profesor</label>
        <input id="profesor" name="profesor" type="text" maxlength="100" placeholder="Nombre del profesor" required />
      </div>
      <div>
        <label for="aula">Aula</label>
        <input id="aula" name="aula" type="number" min="1" max="47" required placeholder="Número de aula (1-47)"
        style="width:6rem;" />
      </div>
      <div>
        <label for="aulaEspecial">Aula Especial</label>
        <input id="aulaEspecial" name="aulaEspecial" type="text" maxlength="25" placeholder="Nombre de aula especial"
        style="width: 15rem;" />
      </div>
      </div>
      <div id="errorMsg" class="error-msg"></div>
      <div>
      <button type="submit">Enviar</button>
      </div>
    </form>
    </div>
  </div>
  <div id='calendar'></div>
@endsection