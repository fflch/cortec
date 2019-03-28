@extends('master')

@section('content')
  <form method="POST" name="corpus" action="/avisos/">
      {{ csrf_field() }}

      <div class="">
          <h2>Exibição de aviso</h2>
      </div>

      <div class="form-group mt-3">
        <label for="titulo">Nome</label>
        <input type="text" class="form-control" name="titulo" id="titulo" required placeholder="Ex.: Aviso!">
      </div>

      <div class="form-group" >
        <label for="texto">Texto</label>
        <textarea class="form-control" id="texto" name="texto" rows="16" required></textarea>
      </div>

      <button type="submit" class="btn btn-success">Salvar</button>
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
@if ($errors->any())
    <script>
      var modal = new bsn.Modal(document.getElementById('modalWarning'));
      modal.show();
    </script>
@endif
@endsection
