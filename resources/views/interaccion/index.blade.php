<h1>Preferencias</h1>
<table class="table table-light">
    <thead class="thead-light">
    <tr>
        <th>ID</th>
        <th>Perro_interesado</th>
        <th>Perro candidato</th>
        <th>Preferencia</th>
        <th>Fecha de Ingreso</th>
    </tr>
    </thead>
    <tbody>
        @foreach( $interaccion as $perfil)
        <tr>
            <td>{{ $perfil-> id}}</td>
            <td>{{ $perfil-> perro_interesado_id}}</td>
            <td>{{ $perfil-> perro_candidato_id}}</td>
            <td>{{ $perfil-> preferencia}}</td>
            <td>{{ $perfil-> created_at}}</td>
        </tr>
        @endforeach
    </tbody>
</table>