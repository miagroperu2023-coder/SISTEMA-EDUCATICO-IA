<div>
    {{-- Be like water. --}}
    <section>
        <div class="contenedor pt-5">
            <h1 class="lead mt-5">Pagos</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- FORMULARIO PARA EDITAR PAGO Y MANDAR CORREO AL USUARIO -->
                            @if ($pay_id)
                                <form wire:submit.prevent="update">
                                    <div class="form-group my-2">
                                        <label for="">Codigo:</label>
                                        <input wire:model="payment_id" type="text" class="form-control"
                                            placeholder="N° de pago">
                                        @error('payment_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Status:</label>
                                        <input wire:model="status" type="text" class="form-control"
                                            placeholder="Status">
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Tipo:</label>
                                        <input wire:model="payment_type" type="text" class="form-control"
                                            placeholder="Tipo">
                                        @error('payment_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Id Preferencia:</label>
                                        <input wire:model="preference_id" type="text" class="form-control"
                                            placeholder="Id Preferencia">
                                        @error('preference_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Estado Actual:</label>
                                        <input wire:model="estado" type="text" class="form-control"
                                            placeholder="Estado Actual">
                                        @error('estado')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="mi-boton azul w-100 mt-2">Autorzar Curso</button>
                                </form>
                            @endif
                            <!-- FORMULARIO PARA CREAR UNA CATEGORIA DEL CURSO -->
                        </div>
                    </div>




                </div>

                <div class="col-md-8">
                    <div class="card sombra">
                        <div class="card-header fondo-general">
                            <h2 class="lead text-white">Pagos</h2>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>USUARIO</th>
                                        <th>PAGO</th>
                                        <th>ESTADO</th>
                                        <th>
                                            ACTIVAR
                                        </th>
                                        <th>
                                            CANCELAR
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pays as $pay)
                                        <tr>
                                            <td>{{ $pay->id }}</td>
                                            <td>{{ $pay->name }}</td>
                                            <td>{{ $pay->payment_id }}</td>
                                            <td>{{ $pay->estado }}</td>

                                            <td class="text-center">
                                                @if ($pay->estado == 'CANCELADO')
                                                    <button wire:click="activeSuscription({{ $pay->id }})"
                                                        class="mi-boton azul btn-sm"><i
                                                            class='bx bx-check bx-tada'></i></button>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                @if ($pay->estado == 'SUSCRITO')
                                                    <button wire:click="cancelSuscription({{ $pay->id }})"
                                                        class="mi-boton rojo btn-sm"><i
                                                            class='bx bx-message-alt-x bx-burst'></i></button>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    @if ($cancelSubscriptionMessage)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ $cancelSubscriptionMessage }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
