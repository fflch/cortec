@extends('master')

@section('content')
  <form method="POST" name="stoplist" action="/stoplist/edit">
      {{ csrf_field() }}

      <div class="form-group">
          <legend class="col-form-label">Idioma</legend>
          <select class="custom-select" id="idioma" name="idioma" required>
              <option selected value="pt">Português</option>
              <option value="en">Inglês</option>
          </select>
      </div>

      <div class="form-group" id="div_upload">
          <label for="upload_field">Upload</label>
          <input type="file" class="form-control-file" id="upload_field" name="upload_field" accept=".txt">
      </div>

      <div class="form-group" id="div_conteudo">
          <label for="conteudo">Conteúdo</label>
          <textarea class="form-control" id="conteudo" name="conteudo" rows="5" required></textarea>
      </div>

      <button type="submit" class="btn btn-success">Salvar</button>
  </form>
@endsection


@section('javascripts')
  @parent
  <script type="text/javascript" src="{{ asset('/js/utils.js') }}"></script>
  <script>
      document.getElementById('upload_field').addEventListener('change', function(evt) {
        var file = document.getElementById('upload_field').files[0];

        readTxt(file, function (result) {
            document.getElementById('conteudo').value = result;
        });

      }, false);
  </script>
@endsection
