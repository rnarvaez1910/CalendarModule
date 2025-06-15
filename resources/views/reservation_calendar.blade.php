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
    <script>
        var calendar;
        document.addEventListener('DOMContentLoaded', function() {
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
                        duration: {
                            days: 7
                        },
                        buttonText: 'Semana'
                    },
                    dayGridMonth: {
                        buttonText: 'Mes'
                    },
                },
                dateClick: function(info) {
                    // Calcula el lunes de la semana del día seleccionado
                    var date = new Date(info.date);
                    var day = date.getDay(); // 0=domingo, 1=lunes,...,6=sábado
                    var diff = (day === 0 ? -6 : 1 -
                        day); // Si es domingo, retrocede 6 días, si no, retrocede hasta lunes
                    date.setDate(date.getDate() + diff);
                    // Formatea la fecha a YYYY-MM-DD
                    var mondayStr = date.toISOString().split('T')[0];
                    // Cambia la vista a la semana personalizada comenzando en ese lunes
                    calendar.changeView('customWeek', mondayStr);
                },
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
        });
        var a = 0;

        function botonCrear() {
            calendar.addEvent({
                id: 'a' + a,
                title: 'titulo',
                start: new Date(),
                end: new Date(new Date().getTime() + 3600000)
            });
            a++;
        }
    </script>
    <form class="d-flex flex-column gap-2">
        <?php
        abstract class Usuario
        {
            public $nombre;
            protected $apellido;
            private $email;
            public function saludo()
            {
                return 'hola';
            }
        }
        class Cliente extends Usuario
        {
            public $telefono;
            public $direccion;
        }
        class Empleado extends Usuario
        {
            public $cargo;
            public $sueldo;
        }
        $cliente = new Cliente();
        $cliente2 = new Cliente();
        $cliente->nombre = '1verth0';
        $cliente2->nombre = 'reismon';
        echo $cliente->nombre . ' es el que tiene mas plata de todos <br>';
        echo $cliente2->nombre . ' no tiene plata porque lo aposto en caballo';
        ?>
        <div>
            <input type="date" />
        </div>
        <div class="d-flex gap-2">
            <input style="width:3rem;" type="number" max="12" min="0" />
            <span>:</span>
            <input style="width:3rem;" type="number" max="59" min="0" />
            <span>-</span>
            <input style="width:3rem;" type="number" max="12" min="0" />
            <span>:</span>
            <input style="width:3rem;" type="number" max="59" min="0" />
        </div>
        <div>
            <label>VideoBeam</label>
            <input type="checkbox" />
            <input type="radio" name="nombre" />
            <input type="radio" name="nombre" />
        </div>
        <div>
            <label>Laptop</label>
            <input type="checkbox" />
        </div>
        <div>
            <label>Extension Electrica</label>
            <input type="checkbox" />
        </div>
        <div>
            <label>Adaptador</label>
            <input type="checkbox" />
        </div>
        <div>
            <button>Enviar</button>
        </div>
    </form>
    <button onclick="botonCrear()">Crear nueva reserva</button>
    <div id="calendar"></div>
@endsection
