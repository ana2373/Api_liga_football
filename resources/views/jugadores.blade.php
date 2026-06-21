@extends('layouts.app')

@section('content')

<h1 class="text-center mb-4">
    👨‍💼 Jugadores
</h1>

<div class="card shadow">
    <div class="card-header bg-dark text-white">
        <h4 class="mb-0">Listado de Jugadores</h4>
    </div>

    <div class="card-body">

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Posición</th>
                    <th>Equipo</th>
                </tr>
            </thead>

            <tbody id="tablaJugadores"></tbody>

        </table>

    </div>
</div>

<script>
fetch('/api/players')
    .then(response => response.json())
    .then(data => {

        let tabla = document.getElementById('tablaJugadores');
        tabla.innerHTML = '';

        data.forEach(player => {

            tabla.innerHTML += `
                <tr>
                    <td>${player.name}</td>
                    <td>${player.position}</td>
                    <td>${player.team ? player.team.name : 'Sin equipo'}</td>
                </tr>
            `;

        });

    })
    .catch(error => {

        document.getElementById('tablaJugadores').innerHTML = `
            <tr>
                <td colspan="3" class="text-danger text-center">
                    Error al cargar los jugadores
                </td>
            </tr>
        `;
    });
</script>

@endsection