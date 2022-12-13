<h2> {{ $modo }} perro </h2>

@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
<ul>    
    @foreach( $errors->all() as $error)
    <li> {{$error}} </li>
    @endforeach
</ul>
</div>
@endif

<div class="form-group">
<label for="perro_nombre"> Nombre del Perro</label>
<input type="text" name="perro_nombre"  class="form-control"
 value="{{ isset($perfil->perro_nombre)?$perfil->perro_nombre:old('perro_nombre')}}" id="perro_nombre"/>
<br>
</div>

<div class="form-group">
<label for="perro_descripcion"> Descripción del Perro</label>
<input type="text" name="perro_descripcion" class="form-control"
 value="{{ isset($perfil->perro_descripcion)?$perfil->perro_descripcion:old('perro_descripcion')}}" id="perro_descripcion">
<br>
</div>

<div class="form-group">
<label for="perro_foto"> Foto del Perro</label>
<input type="file" name="perro_foto" class="form-control"
 value="{{ isset($perfil->perro_foto)?$perfil->perro_foto:old('perro_foto')}}" id="perro_foto">
<br>
</div>

<a href="{{url('perro')}}" class="btn btn-secondary"> <i class="fa-solid fa-turn-down-left"></i>Volver</a>
<input type="submit"  class="btn btn-primary" value="{{ $modo }} perro"> <br>