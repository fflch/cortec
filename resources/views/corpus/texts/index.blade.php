@extends('master')

@section('content')
  <div class="row mb-3">
    Corpus: <a href="/corpus/{{$corpus->id}}"><b>{{ $corpus->titulo }}</b></a>
  </div>

  <div class="container-lista">
    <div class="row">
      <a class="btn btn-success" href="/corpus/{{ $corpus->id }}/text/create">Adicionar Texto</a>
    </div>
    <div class="row align-items-center row-header-lista px-1 mt-4">
      <div class="col-xs-1 text-center">
        <h3 class="h3 h3-lista">Lista de Textos</h3>
      </div>
    </div>
    <div class="row bg-gray pb-3">
      <div class="col">
        <ul class="corpora list-group" style='width:100%'>
          @foreach ($corpus->texts as $text)
            <li class="corpora list-group-item list-group-item-action">
              <div class="row align-items-center">
                <div class="col-sm-3">
                  {{ $text->created_at->formatLocalized('%d/%m/%G %k:%M:%S')}}
                </div>
                <div class="col-sm-3">
                  {{ str_limit($text->conteudo, 100) }}
                </div>
                <div class="col-sm-1">
                  <span class="badge badge-secondary">{{$text->idioma}}</span>
                </div>
                <div class="col-sm-3 text-center">
                  <a href="/corpus/{{ $corpus->id }}/text/{{ $text->id }}/edit" class="btn btn-outline-secondary mx-1">Editar</a>
                </div>
                <div class="col-sm-2 text-center">
                  <form class="delete" method="POST" action="/corpus/{{ $corpus->id }}/text/{{ $text->id }}" onsubmit="return confirm('{!! __('messages.confirma') !!}');">
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
    </div>
    <div class="row mt-4">
      {{ $corpus->texts->links() }}
    </div>

  </div>
@endsection
