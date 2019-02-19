@extends('master')

@section('content')
  <div class="container-lista">
    <div class="row">
      <h2>Passo 3/3: Aplicando a Ferramenta sobre o Corpus.</h2>
    </div>
    <div class="row mt-10">
      <p>Configure a ferramenta usando as opções abaixo:</p>
    </div>

    <form name="step2" action="/analysis/ngrams" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="tool" value="ngrams">

      <div class="row align-items-center row-header-lista px-1">
        <div class="col-xs-1 text-center">
          <h3 class="h3 h3-lista">Gerador de N-Gramas</h3>
        </div>
      </div>

      <div class="row bg-gray row pt-3">
        <div class="col">
          <div class="container">
            <div class="form-group row align-items-center justify-content-center">
              <label for="nGramSize" class="col-md-4 col-form-label">Tamanho dos n-gramas:</label>
              <div class="col-12 col-md-3 col-lg-2">
                <select class="form-control" id="nGramSize" name="nGramSize" required>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </div>
            </div>
            <div class="form-group row align-items-center justify-content-center">
              <label for="stats" class="col-md-4 col-form-label">Incluir estatísticas de associação? (Disponível para bigramas e trigramas, somente)</label>
              <div class="col-12 col-md-3 col-lg-2">
                <select class="form-control" id="stats" name="stats">
                  <option value="">Não</option>
                </select>
              </div>
            </div>
            <div class="form-group row align-items-center justify-content-center">
              <label for="contexto" class="col-md-4 col-form-label">Deseja utilizar uma Stoplist?</label>
              <div class="col-12 col-md-3 col-lg-2">
                <select class="form-control" id="stopList" name="stopList" required>
                  <option value="default">Padrão</option>
                  <option>Particular</option>
                </select>
              </div>
            </div>
            <div class="form-group row align-items-center justify-content-center">
              <label for="stats" class="col-md-4 col-form-label">Cortar os itens com frequência menor a:</label>
              <div class="col-12 col-md-3 col-lg-2">
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
  <script>
    var modal = new bsn.Modal(document.getElementById('modalWarning'));
    @if ($errors->any()) modal.show(); @endif
  </script>
@endsection
