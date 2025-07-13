<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <style>
        @media print {
            @page {
                size: landscape;
            }
        }

        body {
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            color: #000;
            border: 1px solid #000;
            border-collapse: collapse;
        }

        th,
        td {
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            font-weight: normal;
            padding-left: 15px;
            padding-right: 15px;
            max-width: 200px
        }

        th {
            text-align: center;
        }

        .main>div {
            display: inline-block;
        }

        .a {
            padding-right: 5px;
            margin-right: 5px;
        }

        .b {
            border-left: 5px solid black;
            padding-left: 5px;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <table class="reservation">
        <span><img src="{{ URL::asset('image/logo-academico.png') }}" style="width:350px"></span>
        <tr>
            <th>
                Profesor
            </th>
            <th>
                Hora de inicio
            </th>
            <th>
                Hora de fin
            </th>
            <th>
                Insumos
            </th>
            <th>
                Aula
            </th>
            <th>
                Asignatura
            </th>
            @if (!$declined)
                <th colspan="2" id="receive">
                    Quien recibe (Nombre y firma)
                </th>
                <th colspan="2" id="delivery">
                    Quien entrega (Nombre y firma)
                </th>
            @endif
        </tr>
        @foreach ($reservations as $reservation)
            <tr>
                <td>
                    {{ $reservation->professor_name }}
                </td>
                <td>
                    {{ $reservation->reservation_start->format('Y-m-d H:i:s') }}
                </td>
                <td>
                    {{ $reservation->reservation_end->format('Y-m-d H:i:s') }}
                </td>
                <td>
                    <ul>
                        @foreach ($reservation->assets_reservation as $assetReservation)
                            <li>{{ $assetReservation->assets->name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    {{ $reservation->classroom }}
                </td>
                <td>
                    {{ $reservation->asignature }}
                </td>
                @if (!$declined)
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                @endif
            </tr>
        @endforeach
    </table>
    <script>
        window.print();
        window.onafterprint = function() {
            window.close();
        };
    </script>
</body>

</html>
