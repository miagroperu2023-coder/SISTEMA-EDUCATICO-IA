@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('main')
    @can('notSubscription', auth()->user())
        <!--Cupones de descuento-->
        @include('helpers.plan-descuento')
    @endcan

    <!-- Ahora incluimos la vista suscripcion.blade.php -->
    @include('helpers.suscripcion')


    @include('template.footer')
@endsection
