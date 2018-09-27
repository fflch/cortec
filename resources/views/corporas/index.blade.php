@extends('master')

@section('content')
  <div class="container-lista">
    <div class="row">
      <a class="btn btn-success" href="/corporas/create" >Criar Corpora</a>
    </div>
    <div class="row align-items-center row-header-lista px-1 mt-4">
      <div class="col-xs-1 text-center">
        <h3 class="h3 h3-lista">{!! __('texts.passo1.lista') !!}</h3>
      </div>
    </div>
    <div class="row" >
        <ul class="corpora list-group" style='width:100%'>
          @foreach ($corporas as $corpora)
            <li class="corpora list-group-item list-group-item-action">
              <div class="row align-items-center">
                <div class="col">
                  <a href="/corporas/{{ $corpora->id }}">{{ $corpora->titulo }}</a>
                </div>
                <div class="col">
                  <a href="/corporas/{{ $corpora->id }}/corpus/" class="btn btn-outline-secondary mx-1">Listar Corpus</a>
                </div>
                <div class="col">
                  <a href="/corporas/{{ $corpora->id }}/edit" class="btn btn-outline-secondary mx-1">Editar</a>
                </div>
                <div class="col">
                  <form class="delete" method="POST" action="/corporas/{{ $corpora->id }}" onsubmit="return confirm('{!! __('messages.confirma') !!}');">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-outline-danger mx-1">Apagar</button>
                  </form>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
    </div>
    <div class="row mt-4">
      {{ $corporas->links() }}
    </div>

  </div>
@endsection
