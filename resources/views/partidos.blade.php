@extends('layouts.app')

@section('content')

<h1 class="text-center mb-4">
    ⚽ Partidos
</h1>

<div class="card shadow">

    <div class="card-header bg-dark text-white">
        <h4 class="mb-0">Listado de Partidos</h4>
    </div>

    <div class="card-body">

        <table class="table table-striped table-hover">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Equipo Local</th>
                    <th>Equipo Visitante</th>
                </tr>
            </thead>

            <tbody id="tablaPartidos">

            </tbody>

        </table>

    </div>

</div>

<script>

fetch('/api/games')
    .then(response => response.json())
    .then(data => {

        let tabla = document.getElementById('tablaPartidos');

        tabla.innerHTML = '';

        data.forEach(game => {

            tabla.innerHTML += `
                <tr>
                    <td>${game.id}</td>
                    <td>${game.date}</td>
                    <td>${game.local_team?.name ?? 'Sin equipo'}</td>
                    <td>${game.visitor_team?.name ?? 'Sin equipo'}</td>
                </tr>
            `;

        });

    })
    .catch(error => {

        console.error(error);

        document.getElementById('tablaPartidos').innerHTML = `
            <tr>
                <td colspan="4" class="text-danger text-center">
                    Error al cargar los partidos
                </td>
            </tr>
        `;

    });

</script>

@endsection