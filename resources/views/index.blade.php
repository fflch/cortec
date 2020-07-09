@extends('master')

@section('content')

    @if (!empty($aviso))
    @if ($aviso->ativado)
        <div class="row">
            <div class="col">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">{{$aviso->titulo}}</h1>
                        <span class="lead">{!!$aviso->texto!!}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @endif

    <div class="row">
      <h2>{!! __('texts.passo2.passo') !!}</h2>
    </div>
    <div class="row mt-10">
      <p>{!! __('texts.passo2.texto1') !!}</p>
    </div>

    <form name="step1" action="/analysis/process" method="post" >
      {{ csrf_field() }}

      {{-- SELEÇÃO DA FERRAMENTA --}}

      <div class="row align-items-center row-header-lista px-1">
        <div class="col-xs-1 text-center">
          <h3 class="h3 h3-lista">{!! __('texts.passo2.lista') !!}</h3>
        </div>
      </div>
      <div class="row bg-gray">
        <div class="col-lg-1-12">
          <ul class="mt-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="tool" id="concordanciador" value="concordanciador" checked>
              <label class="form-check-label" for="concordanciador">
                {!! __('texts.categorias.concordanciador') !!}
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="tool" id="lista_palavras" value="lista_palavras">
              <label class="form-check-label" for="lista_palavras">
                {!! __('texts.categorias.gerador1') !!}
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="tool" id="n_grams" value="n_grams">
              <label class="form-check-label" for="n_grams">
                {!! __('texts.categorias.gerador2') !!}
              </label>
            </div>
          </ul>
        </div>
      </div>

      {{-- SELEÇÃO DE IDIOMA --}}
      <div class="row mt-4">
        <h2>{!! __('texts.passo1.passo') !!}</h2>
      </div>
      <div class="row mt-10">
        <p>{!! __('texts.passo1.texto1') !!}</p>
      </div>

      <div class="row align-items-center row-header-lista px-1">
        <div class="col-xs-1 text-center">
          <h3 class="h3 h3-lista">{!! __('texts.passo1.lingua') !!}</h3>
        </div>
      </div>
      <div class="row bg-gray">
        <div class="col-lg-1-12">
          <ul class="mt-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="language" id="radio_pt" value="pt" checked>
              <label class="form-check-label" for="radio_pt">
                {!! __('texts.passo1.lingua1') !!}
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="language" id="radio_en" value="en">
              <label class="form-check-label" for="radio_en">
                {!! __('texts.passo1.lingua2') !!}
              </label>
            </div>
          </ul>
        </div>
      </div>

      {{-- SELEÇÃO DE CORPORA --}}

      <div class="row align-items-center row-header-lista px-1 mt-4">
        <div class="col-xs-1 text-center">
          <h3 class="h3 h3-lista">{!! __('texts.passo1.lista') !!}</h3>
        </div>
      </div>
      <div class="row bg-gray pb-4" id="div_corpuses">
        @foreach ($categorias as $categoria)
          <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2" data-cat="{{$categoria->id}}">
            <div class="card">
              <label for="check_cat_{{$categoria->id}}" class="mb-0">
                <div class="card-header list-group-item-action">
                  <input type="checkbox" id="check_cat_{{$categoria->id}}" value="{{$categoria->id}}">
                  <a style="cursor:pointer;" onclick="javascript:location.href='/categorias/'+document.forms['step1'].language.value+'/{{$categoria->id}}'">
                    {{$categoria->nome}}
                  </a>
                  <div class="float-right btn btn-light btn-sm" data-toggle="collapse" data-target="#list_corp_{{$categoria->id}}" aria-expanded="false" style="line-height: 0.85rem">
                      <span class="font-weight-bold" style="font-size: 1.25rem;">+</span>
                  </div>
                </div>
              </label>
              <ul class="collapse list-group list-group-flush" id="list_corp_{{$categoria->id}}">
                @php
                  $corpuses = $categoria->corpuses->sortBy('titulo');
                  $corpuses = $corpuses->filter(function ($corpus, $key) {
                      return (count($corpus->texts) > 0);
                  });
                @endphp
                @foreach ($corpuses as $corpus)
                  <label for="check_{{$categoria->id}}_{{$corpus->id}}" style="margin-bottom: 0;">
                    <li class="list-group-item list-group-item-action" data-lang="{{implode('|', $corpus->getLanguages()->toArray())}}" id="li_{{$categoria->id}}_{{$corpus->id}}">
                    <input type="checkbox" name="corpuses[]" value="{{ $corpus->id }}" id="check_{{$categoria->id}}_{{$corpus->id}}">
                      <a style="font-weight:normal;cursor:pointer;" onclick="javascript:location.href='/categorias/'+document.forms['step1'].language.value+'/{{$categoria->id}}/{{$corpus->id}}#{{$corpus->id}}'">
                        {{ $corpus->titulo }}
                      </a>
                    </li>
                  </label>
                @endforeach
              </ul>
            </div>
          </div>
        @endforeach
      </div>

      <div class="row">
        <div class="col text-right mt-4 pr-0">
          <button type="submit" class="btn btn-success text-right">{!! __('basic.buttons.proximo_passo') !!}</button>
        </div>
      </div>
    </form>

  @if ($errors->any())
  <div class="modal" tabindex="-1" role="dialog" id="modalWarning">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">{!! __('messages.validacao.header') !!}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                @foreach ($errors->all() as $error)
                    <p>{!! $error !!}</p>
                @endforeach
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
              </div>
          </div>
      </div>
  </div>
  @endif
@endsection

@section('javascripts')
  @parent
  <script type="text/javascript" src="{{ asset('/js/analise/analise_form.js') }}"></script>
  @if ($errors->any())
      <script>
        var modal = new bsn.Modal(document.getElementById('modalWarning'));
        modal.show();
      </script>
  @endif
@endsection
