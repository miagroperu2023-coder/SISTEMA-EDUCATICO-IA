@if ($current->description)
    <!-- Button trigger modal -->
    <button type="button" class="mi-boton general mt-3" data-bs-toggle="modal" data-bs-target="#ModalMaterialReferencia">
        Referencia del Material:
    </button>

    <!-- Modal cita del material-->
    <div class="modal fade" id="ModalMaterialReferencia" tabindex="-1" aria-labelledby="ModalMaterialReferenciaLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalMaterialReferenciaLabel">
                        Referencia del
                        Material:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">

                                <strong class="d-block mb-2">📚 Referencia documental académica</strong>

                                <p class="mb-2">
                                    <strong>{{ $course->title }}</strong><br>
                                    Universidad Nacional Federico Villarreal (2018)
                                </p>

                                <p class="mb-2">
                                    <strong>Fuente original:</strong>
                                    <a target="_blank" href="{{ $current->description->name }}"
                                        title="{{ $current->description->name }}">
                                        Consultar documento de referencia
                                    </a>
                                </p>

                                <p class="mb-0">
                                    <em>
                                        <strong>
                                            Este recurso pertenece a su fuente original y es referenciado dentro de la
                                            plataforma
                                            con fines exclusivamente educativos. EdPerú reconoce y respeta la autoría
                                            correspondiente,
                                            promoviendo el acceso responsable al conocimiento mediante la debida
                                            citación de la fuente.
                                        </strong>
                                    </em>
                                </p>

                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar">
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="mi-boton general" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endif
