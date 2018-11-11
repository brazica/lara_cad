@extends('layout.app', ["current" => "plataform"])

@section('body')
<div class="card border">
    <div class="card-body">
      <h5 class="card-title">Cadastro de Plataforma</h5>

      <table class="table table-ordered table-hover">
          <thead>
            <tr>
              <th>Código </th>
              <th>Nome da Platafoma </th>
              <th>Ações </th>
            </tr>
          </thead>
          <tbody>
    @foreach( $plata as $plat )
            <tr>
              <td>{{ $plat->id }}</td>
              <td>{{ $plat->name }} </td>
              <td>
                  <a href="/plataform/edit/{{ $plat->id }}" class="btn btn-sm btn-primary">Editar</a>
                  <a href="/plataform/delete/{{ $plat->id }}" class="btn btn-sm btn-danger">Apagar</a>
              </td>
            </tr>
    @endforeach

          </tbody>
      </table>
    </div>
    <div class="card-footer">
        <a href="/plataform/new" class="btn btn-sm btn-primary" role="button">Nova Plataforma</a>

    </div>
</div>


@endsection
