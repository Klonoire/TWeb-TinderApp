ah no te gustó la wea?
<form action="{{url('/perro/'.$perfil->id )}}" method="post" enctype="multipart/form-data" >
@csrf
{{ method_field('PATCH') }}
@include('perro.form', ['modo'=>'Editar']);
</form>