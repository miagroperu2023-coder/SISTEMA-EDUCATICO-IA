<form action="{{ route('visitador.course.alert') }}" id="fromLinkCaido" method="POST">
    @csrf
    <input type="text" name="id_lesson" value="{{ $current->id }}" hidden>
    <button type="submit" class="mi-boton general mt-3" id="alertButton">Alertar
        Link caido</button>
</form>
