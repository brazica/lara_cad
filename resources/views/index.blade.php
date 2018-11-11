@extends('layout.app', ["current" => "home"])

@section('body')

<div class="jumbotron bg-light border border-secondary">
    <div class="row">
        <div class="card-deck">
            <div class="card border border-primary">
                <div class="card-body">
                    <h5 class="card-title">Cadastro de Games </h5>
                    <p class="card=text">
                        *Não esqueçer de cadastrar previamente as Plataformas
                    </p>
                    <a href="/games" class="btn btn-primary">Cadastre seus Games </a>
                </div>
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                    <h5 class="card-title">Cadastro da Plataformas </h5>
                    <p class="card=text">
                          Cadastre aqui as suas Plataformas dos seus Games
                    </p>
                    <a href="/plataform" class="btn btn-primary">Cadastre suas Plataformas </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
