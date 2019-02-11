@extends('master')

@section('content')
    <div class="row">
      <div class="col">
          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">Aviso</h1>
              <p class="lead">Este site está sendo atualizado. Enquanto isso, por gentileza, acesse o antigo em <a href="http://oldcortec.fflch.usp.br" target="_self">oldcortec.fflch.usp.br</a>.</p>
            </div>
          </div>
      </div>
    </div>

    <div class="row">
      <h2>{!! __('texts.passo1.passo') !!}</h2>
    </div>
    <div class="row mt-10">
      <p>{!! __('texts.passo1.texto1') !!}</p>
    </div>

    <form name="step1" action="/analysis/tool" method="post" >
      {{ csrf_field() }}

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

      <div class="row align-items-center row-header-lista px-1 mt-4">
        <div class="col-xs-1 text-center">
          <h3 class="h3 h3-lista">{!! __('texts.passo1.lista') !!}</h3>
        </div>
      </div>
      <div class="row bg-gray pb-4" id="div_corpuses">
        @foreach ($categorias as $categoria)
          <div class="col-sm-3 mt-2" data-cat="{{$categoria->id}}">
            <div class="card">
              <label for="check_cat_{{$categoria->id}}" style="margin-bottom: 0;">
                <div class="card-header list-group-item-action">
                  <input type="checkbox" id="check_cat_{{$categoria->id}}" value="{{$categoria->id}}">
                  <a href="/categorias/{{$categoria->id}}"/>{{$categoria->nome}}</a>
                </div>
              </label>
              <ul class="list-group list-group-flush" id="list_corp">
                @php
                  $corpuses = $categoria->corpuses->filter(function ($corpus, $key) {
                      return (count($corpus->texts) > 0);
                  });
                @endphp
                @foreach ($corpuses as $corpus)
                  <label for="check_{{$categoria->id}}_{{$corpus->id}}" style="margin-bottom: 0;">
                    <li class="list-group-item list-group-item-action" data-lang="{{implode('|', $corpus->getLanguages()->toArray())}}" id="li_{{$categoria->id}}_{{$corpus->id}}">
                    <input type="checkbox" name="corpuses[]" value="{{ $corpus->id }}" id="check_{{$categoria->id}}_{{$corpus->id}}">
                      <a href="/categorias/{{$categoria->id}}#{{ $corpus->id }}" style="font-weight:normal;">
                        {{ $corpus->titulo }}
                      </a>
                      @foreach ($corpus->getLanguages() as $lang)
                        <span class="badge badge-secondary">{{$lang}}</span>
                      @endforeach
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
  <script type="text/javascript" src="{{ asset('/js/corpuses/analise_form.js') }}"></script>
  @if ($errors->any())
      <script>
        var modal = new bsn.Modal(document.getElementById('modalWarning'));
        modal.show();
      </script>
  @endif
@endsection
