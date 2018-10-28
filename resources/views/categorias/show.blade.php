@extends('master')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="row sticky-top">
        <div class="col">
          <div class="row">
            <div class="col">
              <h1>{!! __('texts.categorias.texto1') !!} {{$categoria->nome}}</h1>
              <p>{!! __('texts.categorias.texto2', ['count' => count($categoria->corporas)]) !!}</p>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div id="list-example" class="list-group">
                @foreach ($corporas as $corpora)
                  <a class="list-group-item list-group-item-action" href="#{{ $corpora->id }}">{{ $corpora->titulo }}</a>
                @endforeach
              </div>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col">
              <p>{!! __('texts.categorias.texto3') !!}</p>
              <p>{!! __('texts.categorias.texto4') !!}</p>
              <ul>
                <li>{!! __('texts.categorias.concordanceador') !!}</li>
                <li>{!! __('texts.categorias.gerador1') !!}</li>
                <li>{!! __('texts.categorias.gerador2') !!}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="row">
        <div class="col">
          @foreach ($categoria->corporas as $corpora)
            <div class="card mt-3 ">
              <a name="{{ $corpora->id }}"></a>
              <div class="card-header">
                <h3>{{ $corpora->titulo }}</h3>
              </div>
              <div class="card-body">
                <p>{{ $corpora->descricao }}</p>
                <div class="row justify-content-md-center">
                  <div class="col-xs-4">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">{{ $corpora->titulo }}</th>
                          <th scope="col" class="text-center">Inglês</th>
                          <th scope="col" class="text-center">Português</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">Ocorrências/tokens</th>
                          <td class="text-center">{{$corpora->getAnalysis('count-tokens', 'en')}}</td>
                          <td class="text-center">{{$corpora->getAnalysis('count-tokens')}}</td>
                        </tr>
                        <tr>
                          <th scope="row">Formas/types</th>
                          <td class="text-center">{{$corpora->getAnalysis('count-types','en')}}</td>
                          <td class="text-center">{{$corpora->getAnalysis('count-types')}}</td>
                        </tr>
                        <tr>
                          <th scope="row">T/T ratio</th>
                          <td class="text-center">{{round($corpora->getAnalysis('ratio', 'en'), 2)}}</td>
                          <td class="text-center">{{round($corpora->getAnalysis('ratio'), 2)}}</td>
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
