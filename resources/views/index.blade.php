@extends('master')

@section('content')
  <div class="container-lista">
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
      <div class="row bg-gray pb-4" id="div_corporas">
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
                  $corporas = $categoria->corporas->filter(function ($corpora, $key) {
                      return (count($corpora->corpuses) > 0);
                  });
                @endphp
                @foreach ($corporas as $corpora)
                  <label for="check_{{$categoria->id}}_{{$corpora->id}}" style="margin-bottom: 0;">
                    <li class="list-group-item list-group-item-action" data-lang="{{implode('|', $corpora->getLanguages()->toArray())}}" id="li_{{$categoria->id}}_{{$corpora->id}}">
                    <input type="checkbox" name="corporas[]" value="{{ $corpora->id }}" id="check_{{$categoria->id}}_{{$corpora->id}}">
                      <a href="/categorias/{{$categoria->id}}#{{ $corpora->id }}" style="font-weight:normal;">
                        {{ $corpora->titulo }}
                      </a>
                      @foreach ($corpora->getLanguages() as $lang)
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
  </div>

  <div class="modal" tabindex="-1" role="dialog" id="modalWarning">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{!! __('messages.validacao.modal_step1.header') !!}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{!! __('messages.validacao.modal_step1.body') !!}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('javascripts')
  @parent
  <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/corpuses/analise_form.js') }}"></script>
  <script>
    var modal = new bsn.Modal(document.getElementById('modalWarning'));
    @if ($errors->any()) modal.show(); @endif
  </script>
@endsection
