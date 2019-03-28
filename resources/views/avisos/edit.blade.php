@extends('master')

@section('content')
  <form method="POST" name="corpus" action="/avisos/{{$aviso->id}}">
      {{ csrf_field() }}

      <div class="">
          <h2>Exibição de aviso</h2>
      </div>

      <div class="form-group mt-3">
        <legend class="col-form-label">Ativar aviso?</legend>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="rd_true" name="ativado" value="1" {{($aviso->ativado) ? 'checked' : ''}}>
          <label class="form-check-label" for="rd_true">
            Sim
          </label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" id="rd_false" name="ativado" value="0" {{(!$aviso->ativado) ? 'checked' : ''}}>
          <label class="form-check-label" for="rd_false">
            Não
          </label>
        </div>
      </div>

      <div class="form-group">
        <label for="titulo">Nome</label>
        <input type="text" class="form-control" name="titulo" id="titulo" required placeholder="Ex.: Aviso!" value="{{ $aviso->titulo }}">
      </div>

      <div class="form-group" >
        <label for="texto">Texto</label>
        <textarea class="form-control editor__editable" id="editor" name="texto" required>{{ $aviso->texto }}</textarea>
      </div>

      <button type="submit" class="btn btn-success">Salvar</button>
  </form>
@endsection

@section('javascripts')
  @parent
  <script type="text/javascript" src="{{ asset('/js/plugins/ckeditor.js') }}"></script>
@endsection
