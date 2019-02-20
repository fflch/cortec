@extends('master')

@section('content')
  <div class="container-lista">
    <div class="row">
      <h2>{!! __('texts.ngrams.header1') !!}</h2>
    </div>
    <div class="row mt-10">
      <p>{!! __('texts.ngrams.header2') !!}</p>
    </div>

    <form name="step2" action="/analysis/ngrams" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="tool" value="ngrams">

      <div class="row align-items-center row-header-lista px-1">
        <div class="col-xs-1 text-center">
          <h3 class="h3 h3-lista">{!! __('texts.ngrams.ferramenta') !!}</h3>
        </div>
      </div>

      <div class="row align-items-center justify-content-center bg-gray row pt-3">
        <div class="col">
          <div class="container">
            <div class="form-group row justify-content-center">
              <label for="nGramSize" class="col-md-5 col-form-label">{!! __('texts.ngrams.label1') !!}</label>
              <div class="col-12 col-md-6 col-lg-4">
                <select class="form-control" id="nGramSize" name="nGramSize" onchange="changeStats(this.value)" required>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </div>
            </div>
            <div class="form-group row justify-content-center">
              <label for="stats" class="col-md-5 col-form-label">{!! __('texts.ngrams.label2') !!}</label>
              <div class="col-12 col-md-6 col-lg-4">
                <select class="form-control" id="stats" name="stats">
                  <option value="">{!! __('texts.ngrams.option2_1') !!}</option>
                </select>
              </div>
            </div>
            <div class="form-group row justify-content-center">
              <label for="stopList" class="col-md-5 col-form-label">{!! __('texts.ngrams.label3') !!}</label>
              <div class="col-12 col-md-6 col-lg-4">
                <select class="form-control" id="stopList" name="stopList" onchange="showUpload(this)" required>
                  <option value="default">{!! __('texts.ngrams.option3_1') !!}</option>
                  <option value="custom">{!! __('texts.ngrams.option3_2') !!}</option>
                </select>
              </div>
            </div>

            <div class="form-group row justify-content-center" id="upload_div" style="display:none;">
              <label for="upload_field" class="col-md-5 col-form-label">Upload</label>
              <div class="col-12 col-md-6 col-lg-4">
                  <input type="file" class="form-control-file" id="upload_field" name="upload_field" accept=".txt">
              </div>
            </div>

            <div class="form-group row justify-content-center">
              <label for="stats" class="col-md-5 col-form-label">{!! __('texts.ngrams.label4') !!}</label>
              <div class="col-12 col-md-6 col-lg-4">
                <input type="number" class="form-control" name="remove" min="0" step="1">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col text-right mt-4 pr-0">
          <button type="submit" class="btn btn-success text-right">{!! __('basic.buttons.proximo_passo') !!}</button>
        </div>
      </div>
    </form>

    <div class="modal" tabindex="-1" role="dialog" id="modalWarning">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{!! __('messages.validacao.modal_concord.header') !!}</h5>
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
@endsection

@section('javascripts')
  @parent
  <script type="text/javascript" src="{{ asset('/js/analise/ngrams_form.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/utils.js') }}"></script>
  <script>
    var modal = new bsn.Modal(document.getElementById('modalWarning'));
    @if ($errors->any()) modal.show(); @endif
  </script>
@endsection
