@extends('master')

@section('content')
  <div class="container-lista">
    <div class="row">
      <h2>{!! __('texts.passo3.concord.passo') !!}</h2>
    </div>
    <div class="row mt-10">
      <p>{!! __('texts.passo3.concord.texto1') !!}</p>
    </div>

    <form name="step2" id="form_step2" action="/analysis/concordanciador" method="POST" onsubmit="return onSubmit();">
      {{ csrf_field() }}
      <input type="hidden" name="tool" value="concordanciador">

      <div class="row align-items-center row-header-lista px-1">
        <div class="col-xs-1 text-center">
          <h3 class="h3 h3-lista">{!! __('texts.passo3.concord.ferramenta') !!}</h3>
        </div>
      </div>

      <div class="row bg-gray row pt-3">
        <div class="col">
          <div class="container">
            <div class="form-group row align-items-center">
              <label for="posicao" class="col-md-4 col-form-label">{!! __('texts.passo3.concord.campo1') !!}</label>
              <div class="col-md-4">
                <select class="form-control" id="posicao" name="posicao">
                  <option value="equal">{!! __('texts.passo3.concord.campo1_1') !!}</option>
                  <option value="begin">{!! __('texts.passo3.concord.campo1_2') !!}</option>
                  <option value="end">{!! __('texts.passo3.concord.campo1_3') !!}</option>
                  <option value="contain">{!! __('texts.passo3.concord.campo1_4') !!}</option>
                </select>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" name="termo" required>
              </div>
            </div>
            <div class="form-group row align-items-center">
              <label for="case" class="col-md-4 col-form-label">{!! __('texts.passo3.concord.campo2') !!}</label>
              <div class="col-md-8">
                <input class="" type="checkbox" name="case" id="case">
              </div>
            </div>
            <div class="form-group row align-items-center">
              <label for="contexto" class="col-md-4 col-form-label">{!! __('texts.passo3.concord.campo3') !!}</label>
              <div class="col-3 col-sm-3 col-md-2">
                <select class="form-control" id="contexto" name="contexto">
                  <option>20</option>
                  <option>30</option>
                  <option>40</option>
                  <option>50</option>
                  <option>60</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <input type="hidden" name="corpuses_ids" value="{{ $corpuses_ids }}">
      <input type="hidden" name="language" value="{{ $language }}">

      <div class="row">
        <div class="col text-right mt-4 pr-0">
          <button type="submit" class="btn btn-success text-right">{!! __('basic.buttons.proximo_passo') !!}</button>
        </div>
      </div>
    </form>
  </div>
@endsection
