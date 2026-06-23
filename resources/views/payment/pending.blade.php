@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('main')
    <!-- Ahora incluimos la vista suscripcion.blade.php -->
    @include('helpers.suscripcion')

    @include('template.footer')
@endsection
