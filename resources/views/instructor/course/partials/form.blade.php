<div class="mb-4">
    {{-- PRIMER PARAMETRO : son los campos del modelo mejor dicho de la tabla --}}
    {!! Form::label('title', 'titulo del curso') !!}
    {!! Form::text('title', null, ['class' => 'form-control block']) !!}

    @error('title')
        <span class="text-danger"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="mb-4">
    {{-- PRIMER PARAMETRO : son los campos del modelo mejor dicho de la tabla --}}
    {!! Form::label('subtitle', 'Subtitulo del curso') !!}
    {!! Form::text('subtitle', null, ['class' => 'form-control block']) !!}

    @error('subtitle')
        <span class="text-danger"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="mb-4">
    {{-- PRIMER PARAMETRO : son los campos del modelo mejor dicho de la tabla --}}
    {!! Form::label('description', 'Description del curso') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control block']) !!}

    @error('description')
        <span class="text-danger"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="row">
    <div class="col-md-4">
        {!! Form::label('category_id', 'Categorias') !!}
        {!! Form::select('category_id', $categories, null, ['class' => 'form-select']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('level_id', 'Niveles') !!}
        {!! Form::select('level_id', $levels, null, ['class' => 'form-select']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('price_id', 'Precio') !!}
        {!! Form::select('price_id', $prices, null, ['class' => 'form-select']) !!}
    </div>
</div>

<h3 class="lead mt-4">Imagen del Curso</h3>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <figure>
                    {{-- VALIDA SI EXISTE LA VARIABLE CURSO --}}
                    @isset($course)
                        @if ($course->image)
                            <img style="width: 150px;height: 150px;" src="{{ $course->image->url }}" class=""
                                alt="...">
                        @endif
                    @else
                        <img style="width: 150px;height: 150px;"
                            src="https://images.pexels.com/photos/7509366/pexels-photo-7509366.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            class="" alt="...">
                    @endisset
                </figure>
            </div>
            <div class="col-md-8">
                <p>Coloca la Url de la imagen , puedes ayudarte de esta web <a
                    target="_blank"    href="https://postimages.org/">https://postimages.org/</a></p>
                {!! Form::text('photo', null, [
                    'class' => 'form-control mt-4',
                    'placeholder' => 'por favor de subir con extenciones validas ".png|.jpg"',
                ]) !!}
            </div>
        </div>
    </div>
</div>
