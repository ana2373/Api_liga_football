@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    ⚽ Equipos
</h2>

<table class="table table-striped table-bordered shadow">

    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Ciudad</th>
            <th>Estadio</th>
            <th>Capacidad</th>
            <th>Año Fundación</th>
        </tr>
    </thead>

    <tbody id="tablaEquipos">
    </tbody>

</table>

<script>
fetch('/api/teams')
    .then(response => response.json())
    .then(data => {

        let tabla = document.getElementById('tablaEquipos');

        tabla.innerHTML = '';

        data.forEach(team => {

            tabla.innerHTML += `
                <tr>
                    <td>${team.name}</td>
                    <td>${team.city}</td>
                    <td>${team.stadium}</td>
                    <td>${team.capacity}</td>
                    <td>${team.year_of_fundation}</td>
                </tr>
            `;

        });

    })
    .catch(error => {
        console.error(error);
    });
</script>

@endsection