@extends('master')

@section('content')
  <div class="container-lista">
    <div class="row">
      <a class="btn btn-outline-warning" href="/corporas/create" >Criar Corpora</a>
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
              <div class="row">
                <div class="col">
                  <a href="/corporas/{{ $corpora->id }}">{{ $corpora->titulo }}</a>
                </div>
                <div class="col">
                  <form class="delete" method="POST" action="/corporas/{{ $corpora->id }}" onsubmit="return confirm('{!! __('messages.confirma') !!}');">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger mx-1">Apagar</button>
                  </form>
                </div>
                <div class="col">
                  <form method="GET" action="/corporas/{{ $corpora->id }}/edit">
                    <button type="submit" class="btn btn-info mx-1">Editar</button>
                  </form>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
    </div>

  </div>
@endsection
