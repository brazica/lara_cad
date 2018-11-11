@extends('layout.app', ["current" => "plataform"])

@section('body')

<div class="card border">
  <div class="card-body">
      <form action="/plataform/{{ $plata->id }}" method="POST">
          @csrf
          <div class="form-group">
              <label for="namePlataform">Nome da Plataforma </label>
              <input type="text" class="form-control" name="namePlataform" value="{{ $plata->name }}"
                     id="namePlataform" placeholder="Plataforma">
           </div>
          <button type="submit" class="btn btn-primary btn-sm">Salvar </button>
          <button type="cancel" class="btn btn-danger btn-sm">Cancelar </button>
      </form>
  </div>
</div>

@endsection
