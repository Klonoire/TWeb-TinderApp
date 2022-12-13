Vida de Perros

<h1>Perros</h1>
<a href="{{url('interaccion')}}" class="btn btn-primary"> <i class="fas fa-plus-circle"></i>Ver lista de preferencias</a>
<table class="table table-light">
    <thead class="thead-light">
    <tr>
        <th>ID</th>
        <th>Nombre del Perro</th>
        <th>Foto del Perro</th>
        <th>Descripcion del Perro</th>
        <th>Fecha de Ingreso</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
        @foreach( $perro as $perfil)
        <tr>
            <td>{{ $perfil-> id}}</td>
            <td>{{ $perfil-> perro_nombre}}</td>
            <td>{{ $perfil-> perro_foto}}</td>
            <td>{{ $perfil-> perro_descripcion}}</td>
            <td>{{ $perfil-> created_at}}</td>
            <td>
                <a href="{{url('/perro/'.$perfil->id.'/edit') }}">
                <button type="submit" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editar">
                     <!-- <i class="fas fa-edit"></i> -->
                     Editar
                </button>
                </a>
                <a href="{{url('interaccion/'.$perfil->id)}}" class="btn btn-primary"> <i class="fas fa-plus-circle"></i>
                <button type="submit" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editar">
                     Preferencias
                </button>
                </a>
             <form action="{{ url('/perro/' .$perfil->id) }}" method="post">
                @csrf
                {{ method_field('DELETE') }}
                <input type="submit" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Eliminar" onclick="return confirm('¿Estás seguro/a que deseas eliminar a este Perro? Esto no es reversible')"
                value="Borrar">
                <!-- <i class="fas fa-trash"></i> -->
             </form> 
            </td>
        </tr>
        @endforeach
    </tbody>
</table>