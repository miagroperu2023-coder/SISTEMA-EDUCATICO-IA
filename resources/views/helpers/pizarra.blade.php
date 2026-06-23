<div style="margin-bottom:10px;">
    <button class="btn btn-success mt-2" id="limpiarFirma">Limpiar</button>
    <button type="button" class="btn btn-dark mt-2" id="tool-pencil">✏️ Lápiz</button>
    <button type="button" class="btn btn-danger mt-2" id="tool-eraser">🧽 Borrar</button>
    <div class="row mt-2">
        <div class="col-md-6">
            <input type="color" class="form-control" id="tool-color" value="#000000" title="Escoge un color y de click al boton negro">

        </div>
        <div class="col-md-6">
            <select id="tool-size" class="form-control">
                <option value="2">Fino</option>
                <option value="5" selected>Medio</option>
                <option value="10">Grueso</option>
            </select>
        </div>
    </div>
</div>

<form action="{{ route('visitador.solve.publish.save') }}" id="frmAjaxFirma" method="POST" class="mt-2"
    enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="signature-pad">Pizarra Virtual PreuniCursos:</label>
        <input type="hidden" name="course_id" value="{{ $post->id }}">
        <div class="signature-container">
            <canvas id="signature-pad" class="signature-pad"></canvas>
        </div>
    </div>
    <input type="hidden" name="signature" id="signature" />
    <input type="submit" class="btn btn-outline-primary mt-1 w-100" value="Guardar Resolución">
</form>
