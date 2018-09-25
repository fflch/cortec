@extends('master')

@section('content')
  <div class="container-lista">
    <div class="row">
      <a class="btn btn-success" href="/corporas/{{ $corpora->id }}/corpus/create">Adicionar Corpus</a>
    </div>
    <div class="row align-items-center row-header-lista px-1 mt-4">
      <div class="col-xs-1 text-center">
        <h3 class="h3 h3-lista">{!! __('texts.passo1.lista') !!}</h3>
      </div>
    </div>
    <div class="row" >
        <ul class="corpora list-group" style='width:100%'>
          @foreach ($corpora->corpuses as $corpus)
            <li class="corpora list-group-item list-group-item-action">
              <div class="row align-items-center">
                <div class="col">
                  <a href="/corporas/{{ $corpora->id }}">{{ $corpus->created_at->formatLocalized('%d/%m/%G %k:%M:%S')}}</a>
                </div>
                  <div class="col">
                    <a href="/corporas/{{ $corpora->id }}">{{ str_limit($corpus->conteudo, 100) }}</a>
                  </div>
                <div class="col text-center">
                  <a href="/corporas/{{ $corpora->id }}/corpus/{{ $corpus->id }}/edit" class="btn btn-outline-secondary mx-1">Editar</a>
                </div>
                <div class="col text-center">
                  <form class="delete" method="POST" action="/corpus/{{ $corpora->id }}" onsubmit="return confirm('{!! __('messages.confirma') !!}');">
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
      {{ $corpora->corpuses->links() }}
    </div>

  </div>
@endsection
