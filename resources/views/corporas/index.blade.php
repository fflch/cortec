@extends('master')

@section('content')
  <div class="container-lista">
    <div class="row">
      <div class="col">
        <a class="btn btn-success" href="/categorias/create" >Criar Categoria</a>
        <a class="btn btn-success" href="/corporas/create" >Criar Corpora</a>
      </div>
    </div>
    <div class="row align-items-center row-header-lista px-1 mt-4">
      <div class="col-xs-1 text-center">
        <h3 class="h3 h3-lista">{!! __('texts.passo1.lista') !!}</h3>
      </div>
    </div>
    <div class="row" >
      <div class="col">
        @foreach ($categorias as $categoria)
          <div class="card mt-3">
            <div class="card-header">
              {{ $categoria->nome }}
              <span>
                <a href="/categorias/{{ $categoria->id }}/edit" class="btn btn-sm btn-outline-secondary">Editar</a>
              </span>
              <span>
                <form class="delete" method="POST" action="/categorias/{{ $categoria->id }}" onsubmit="return confirm('{!! __('messages.confirma') !!}');">
                  {{ csrf_field() }}
                  {{ method_field('delete') }}
                <button type="submit" class="btn btn-sm btn-outline-danger">X</button>
              </span>
            </div>
            @foreach ($categoria->corporas as $corpora)
              <ul class="list-group">
                <li class="list-group-item list-group-item-action">
                  <div class="row text-center align-items-center">
                    <div class="col-sm-3">
                      <a href="/corporas/{{ $corpora->id }}">{{ $corpora->titulo }}</a>
                    </div>
                    <div class="col-sm-3">
                      <a href="/corporas/{{ $corpora->id }}/corpus/" class="btn btn-outline-secondary">Listar Corpus</a>
                    </div>
                    <div class="col-sm-3">
                      <a href="/corporas/{{ $corpora->id }}/edit" class="btn btn-outline-secondary">Editar</a>
                    </div>
                    <div class="col-sm-3">
                      <form class="delete" method="POST" action="/corporas/{{ $corpora->id }}" onsubmit="return confirm('{!! __('messages.confirma') !!}');">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-outline-danger">Apagar</button>
                      </form>
                    </div>
                  </div>
                </li>
              </ul>
            @endforeach
          </div>
        @endforeach
      </div>
    </div>
    <div class="row mt-4">
      {{ $categorias->links() }}
    </div>

  </div>
@endsection
