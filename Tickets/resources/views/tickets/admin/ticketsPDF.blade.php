<!DOCTYPE html>
<html>
<head>
    <title>Tickets Filtrados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<!--Download PDF -->
<button id="printButton" onclick="printPage()" class="bg-red-600 text-white px-4 py-2 rounded mb-4">PDF</button>

<!-- Go back -->
<a id="backButton" href="{{ url()->previous() }}" class="bg-gray-500 text-white px-4 py-2 rounded mb-4">Return</a>
<body>
    <h1>Tickets Filtrados</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Autor</th>
                <th>División</th>
                <th>Estado</th>
                <th>Fecha de creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->author->name }}</td>
                    <td>{{ $ticket->author->division->name }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>{{ $ticket->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

<script>
    function printPage() {
        document.getElementById('printButton').classList.add('hidden');
        document.getElementById('backButton').classList.add('hidden'); // Hide the print button during pdf view
        window.print();
        document.getElementById('printButton').classList.remove('hidden');
        document.getElementById('backButton').classList.remove('hidden'); // Show the print button after PDF view
    }
</script>

<style>
    @media print {
        #printButton, #backButton {
            display: none;
        }
        /* Ocultar encabezado, pie de página y otros elementos no necesarios al imprimir */
        header, footer, .sidebar, nav {
            display: none;
        }
        /* Centrar el contenido al imprimir */
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }
        .container {
            margin: 0;
            padding: 0;
            width: 100%;
        }
        .border-b {
            padding-bottom: 0;
        }
        /* Ajustar el ancho de las imágenes */
        img {
            width: 100px;
            height: auto;
        }
        /* Ocultar el botón de volver al imprimir */
        #backButton {
            display: none;
        }
    }
</style>
</html>
