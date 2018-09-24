@extends('master')

@section('content')
  <form method="POST" name="corpus" action="/corporas/{{ $corpora_id }}/corpus">
      {{ csrf_field() }}

      <div class="form-group">
        <legend class="col-form-label">Qual forma inserir o Corpus?</legend>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="modo" id="campo" value="campo" checked>
          <label class="form-check-label" for="campo">
            Campo de digitação
          </label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="modo" id="upload" value="upload">
          <label class="form-check-label" for="exampleRadios1">
            Upload de arquivo de texto (.txt)
          </label>
        </div>
      </div>

      <div class="form-group" id="div_conteudo">
        <label for="conteudo">Conteúdo</label>
        <textarea class="form-control" id="conteudo" name="conteudo" rows="5"></textarea>
      </div>

      <div class="form-group" id="div_upload" style="display:none;">
        <label for="upload">Upload</label>
        <input type="file" class="form-control-file" id="upload_field" name="upload_field">
      </div>

      <button type="submit" class="btn btn-success">Salvar</button>
  </form>
@endsection


@section('javascripts')
  @parent

  <script>
    var radios = document.forms["corpus"].modo;
    var text_field = document.getElementById('div_conteudo');
    var file_field = document.getElementById('div_upload');

    for(radio in radios) {
        radios[radio].onclick = function() {
            if(document.querySelector('input[name="modo"]:checked').value == 'campo'){
              text_field.style.display = "block";
              file_field.style.display = "none";
            }else{
              text_field.style.display = "none";
              file_field.style.display = "block";
            }
        }
    }

  </script>
@endsection
