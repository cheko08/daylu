@extends('layouts.app')

@section('content')


    <div class="container text-center">
        <h1>Cotizaciones Daylu</h1>
        <p class="lead">Escoja el tipo de cotización que deseas realizar.</p>
        <p>
        <a class="btn btn-success btn-lg" role="button" href="{{url('servicios-cotizacion-rapida') }}">Cotización rápida</a>
        <a class="btn btn-primary btn-lg disabled" role="button">Cotización detallada</a>
        </p>

    </div>
    <!-- end container -->

@endsection
