<div class="form-group mb-3">
    {!! Form::label('promo_code', 'Código Promocional', ['class' => 'mb-2']) !!}
    {!! Form::text('promo_code', null, [
        'class' => 'form-control',
        'placeholder' => 'Escriba el código promocional',
    ]) !!}
    @error('promo_code')
        <span class="text-danger"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="form-group mb-3">
    {!! Form::label('name', 'Nombre del Plan', ['class' => 'mb-2']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Escriba el nombre del plan']) !!}
    @error('name')
        <span class="text-danger"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="form-group mb-3">
    {!! Form::label('months', 'Meses de Duración', ['class' => 'mb-2']) !!}
    {!! Form::number('months', null, ['class' => 'form-control', 'placeholder' => 'Ejemplo: 12']) !!}
    @error('months')
        <span class="text-danger"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="form-group mb-3">
    {!! Form::label('monthly_price', 'Precio Mensual', ['class' => 'mb-2']) !!}
    {!! Form::number('monthly_price', null, [
        'class' => 'form-control',
        'step' => '0.01',
        'placeholder' => 'Ejemplo: 99.99',
    ]) !!}
    @error('monthly_price')
        <span class="text-danger"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="form-group mb-3">
    {!! Form::label('percentage', 'Porcentaje de Descuento', ['class' => 'mb-2']) !!}
    {!! Form::number('percentage', null, [
        'class' => 'form-control',
        'step' => '0.01',
        'placeholder' => 'Ejemplo: 10 o 20 %',
    ]) !!}
    @error('percentage')
        <span class="text-danger"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="form-group mb-3">
    {!! Form::label('activo', 'Activo', ['class' => 'mb-2']) !!}
    {!! Form::select('activo', [1 => 'Sí', 0 => 'No'], null, ['class' => 'form-control']) !!}
    @error('activo')
        <span class="text-danger"><strong>{{ $message }}</strong></span>
    @enderror
</div>
