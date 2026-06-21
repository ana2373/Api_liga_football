@extends('layouts.app')

@section('content')

<div class="hero text-center">
    <h1>⚽ Football League</h1>

    <p class="mt-3">
        Sistema para administrar equipos, jugadores y partidos.
    </p>
</div>

<div class="row mt-5">

    <div class="col-md-4">
        <div class="card card-custom shadow">
            <div class="card-body text-center">
                <h3>🏆 Equipos</h3>
                <p>Consulta los equipos registrados.</p>

                <a href="/equipos" class="btn btn-primary">
                    Ver Equipos
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-custom shadow">
            <div class="card-body text-center">
                <h3>👨‍💼 Jugadores</h3>
                <p>Consulta los jugadores registrados.</p>

                <a href="/jugadores" class="btn btn-primary">
                    Ver Jugadores
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-custom shadow">
            <div class="card-body text-center">
                <h3>⚽ Partidos</h3>
                <p>Consulta los partidos de la liga.</p>

                <a href="/partidos" class="btn btn-primary">
                    Ver Partidos
                </a>
            </div>
        </div>
    </div>

</div>

@endsection
