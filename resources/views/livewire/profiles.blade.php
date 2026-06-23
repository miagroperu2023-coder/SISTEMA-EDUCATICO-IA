<div>
    <div class="row">
        {{-- ACTUALIZAR USUARIO --}}
        <div class="mi-card">
            <div class="mi-card-content">

                @if ($this->user_id)
                    <form wire:submit.prevent="updateUser">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" wire:model="name" class="form-control" />
                                </div>

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Email address</label>
                                    <input type="email" readonly value="{{ auth()->user()->email }}"
                                        class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" wire:model="password" placeholder="nueva contraseña"
                                        class="form-control" />
                                </div>

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                @endif
            </div>
        </div>


        <div class="mi-card mt-4">
            <div class="mi-card-content">
                @if ($this->profile_id)
                    <form wire:submit.prevent="updateProfile">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Titulo</label>
                                    <input type="text" wire:model="title" class="form-control"
                                        placeholder="estudinate o tutor" />
                                </div>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Descripcion</label>
                                    <input type="text" wire:model="biography" class="form-control"
                                        placeholder="estudiante de prepa o escolar" />
                                </div>
                                @error('biography')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Sitio web</label>
                                    <input type="text" wire:model="website" class="form-control"
                                        placeholder="midominio.com" />
                                </div>
                                @error('website')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Facebook</label>
                                    <input type="text" wire:model="facebook" class="form-control"
                                        placeholder="facebook" />
                                </div>
                                @error('facebook')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Linkedin</label>
                                    <input type="text" wire:model="linkedin" class="form-control"
                                        placeholder="linkedlin" />
                                </div>
                                @error('linkedin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Youtube</label>
                                    <input type="text" wire:model="youtube" placeholder="youtube"
                                        class="form-control" />
                                </div>
                                @error('youtube')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Tiktok</label>
                                    <input type="text" wire:model="titok" placeholder="titok" class="form-control" />
                                </div>
                                @error('titok')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Snapchat</label>
                                    <input type="text" wire:model="snapchat" placeholder="snapchat"
                                        class="form-control" />
                                </div>
                                @error('snapchat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary">Actualizar</button>
                    </form>
                @endif

                @if (!$this->profile_id)
                    <form wire:submit.prevent="createProfile">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Titulo</label>
                                    <input type="text" wire:model="title" class="form-control"
                                        placeholder="estudiante o tutor" />
                                </div>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Descripcion</label>
                                    <input type="text" wire:model="biography" class="form-control"
                                        placeholder="estudiante de prepa o escolar" />
                                </div>
                                @error('biography')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Sitio web</label>
                                    <input type="text" wire:model="website" class="form-control"
                                        placeholder="midominio.com" />
                                </div>
                                @error('website')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Facebook</label>
                                    <input type="text" wire:model="facebook" class="form-control"
                                        placeholder="facebook" />
                                </div>
                                @error('facebook')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Linkedin</label>
                                    <input type="text" wire:model="linkedin" class="form-control"
                                        placeholder="linkedlin" />
                                </div>
                                @error('linkedin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Youtube</label>
                                    <input type="text" wire:model="youtube" placeholder="youtube"
                                        class="form-control" />
                                </div>
                                @error('youtube')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Tiktok</label>
                                    <input type="text" wire:model="titok" placeholder="titok"
                                        class="form-control" />
                                </div>
                                @error('titok')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Snapchat</label>
                                    <input type="text" wire:model="snapchat" placeholder="snapchat"
                                        class="form-control" />
                                </div>
                                @error('snapchat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary">Guardar</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
