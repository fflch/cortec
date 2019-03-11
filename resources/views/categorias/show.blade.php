@extends('master')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="row sticky-top">
        <div class="col">
          <div class="row">
            <div class="col">
              <h1>{!! __('texts.categorias.texto1') !!} {{$categoria->nome}}</h1>
              <p>{!! trans_choice('texts.categorias.texto2', count($categoria->corpuses), ['count' => count($categoria->corpuses)]) !!}</p>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div id="list-example" class="list-group">
                @foreach ($corpuses as $corpus)
                  <a class="list-group-item list-group-item-action" href="#{{ $corpus->id }}">{{ $corpus->titulo }}</a>
                @endforeach
              </div>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col">
              <p>{!! __('texts.categorias.texto3') !!}</p>
              <p>{!! __('texts.categorias.texto4') !!}</p>
              <ul>
                <li>
                    <form class="concordanciador" method="POST" action="/analysis/process" onsubmit="return confirm('{!! __('messages.confirma_ferramenta') !!}');">
                        {{ csrf_field() }}
                        <input type="hidden" name="language"   value="{{$idioma}}">
                        <input type="hidden" name="tool"       value="concordanciador">
                        @foreach ($corpuses_ids as $corpus_id)
                            <input type="hidden" name="corpuses[]" value="{{$corpus_id}}">
                        @endforeach
                        <button type="submit" class="btn btn-outline-success">
                            {!! __('texts.categorias.concordanciador') !!}
                        </button>
                    </form>
                </li>
                <li>
                    <form class="lista_palavras" method="POST" action="/analysis/process" onsubmit="return confirm('{!! __('messages.confirma_ferramenta') !!}');">
                        {{ csrf_field() }}
                        <input type="hidden" name="language"   value="{{$idioma}}">
                        <input type="hidden" name="tool"       value="lista_palavras">
                        @foreach ($corpuses_ids as $corpus_id)
                            <input type="hidden" name="corpuses[]" value="{{$corpus_id}}">
                        @endforeach
                        <button type="submit" class="btn btn-outline-success">
                            {!! __('texts.categorias.gerador1') !!}
                        </button>
                    </form>
                </li>
                <li>
                    <form class="n_grams" method="POST" action="/analysis/process" onsubmit="return confirm('{!! __('messages.confirma_ferramenta') !!}');">
                        {{ csrf_field() }}
                        <input type="hidden" name="language"   value="{{$idioma}}">
                        <input type="hidden" name="tool"       value="n_grams">
                        @foreach ($corpuses_ids as $corpus_id)
                            <input type="hidden" name="corpuses[]" value="{{$corpus_id}}">
                        @endforeach
                        <button type="submit" class="btn btn-outline-success">
                            {!! __('texts.categorias.gerador2') !!}
                        </button>
                    </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="row">
        <div class="col">
          @foreach ($categoria->corpuses as $corpus)
            <div class="card mt-3 ">
              <a name="{{ $corpus->id }}"></a>
              <div class="card-header">
                <h3>{{ $corpus->titulo }}</h3>
              </div>
              <div class="card-body">
                @if($corpus->descricao)<p>{{ $corpus->descricao }}</p>@endif
                @if($corpus->tipologia)<p><strong>Tipologia Textual:</strong> {{$corpus->tipologia}}</p>@endif
                @if($corpus->compilador)<p><strong>Compilador:</strong> {{$corpus->compilador}}</p>@endif
                @if($corpus->ano)<p><strong>Ano:</strong> {{$corpus->ano}}</p>@endif
                <div class="row justify-content-md-center">
                  <div class="col-xs-4">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">{{ $corpus->titulo }}</th>
                          <th scope="col" class="text-center">{!! __('texts.passo1.lingua2') !!}</th>
                          <th scope="col" class="text-center">{!! __('texts.passo1.lingua1') !!}</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">{!! __('texts.categorias.ocorrencias') !!}</th>
                          <td class="text-center">{{$corpus->getAnalysis('count-tokens', 'en')}}</td>
                          <td class="text-center">{{$corpus->getAnalysis('count-tokens')}}</td>
                        </tr>
                        <tr>
                          <th scope="row">{!! __('texts.categorias.formas') !!}</th>
                          <td class="text-center">{{$corpus->getAnalysis('count-types','en')}}</td>
                          <td class="text-center">{{$corpus->getAnalysis('count-types')}}</td>
                        </tr>
                        <tr>
                          <th scope="row">{!! __('texts.categorias.ratio') !!}</th>
                          <td class="text-center">{{$corpus->getAnalysis('ratio', 'en')}}</td>
                          <td class="text-center">{{$corpus->getAnalysis('ratio')}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>


      </div>
    </div>

  </div>



@endsection
