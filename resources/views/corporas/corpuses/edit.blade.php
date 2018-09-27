@extends('master')

@section('content')
  <form method="POST" name="corpus" action="/corporas/{{ $corpora->id }}/corpus/{{ $corpus->id }}">
      {{ csrf_field() }}

      <div class="form-group">
        <legend class="col-form-label">Qual forma inserir o Corpus?</legend>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="modo" id="campo" value="campo" checked data-show="#div_conteudo">
          <label class="form-check-label" for="campo">
            Campo de digitação
          </label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="modo" id="upload" value="upload" data-show="#div_upload">
          <label class="form-check-label" for="exampleRadios1">
            Upload de arquivo de texto (.txt)
          </label>
        </div>
      </div>

      <div id="fields">
        <div class="form-group" id="div_conteudo">
          <label for="conteudo">Conteúdo</label>
          <textarea class="form-control" id="conteudo" name="conteudo" rows="5">{{ $corpus->conteudo }}</textarea>
        </div>
        <div class="form-group d-none" id="div_upload">
          <label for="upload_field">Upload</label>
          <input type="file" class="form-control-file" id="upload_field" name="upload_field">
        </div>
      </div>

      <button type="submit" class="btn btn-success">Salvar</button>
  </form>
@endsection

@section('javascripts')
  @parent

  <script>
    var radios = document.forms["corpus"].modo;
    for(radio in radios) {
        radios[radio].onclick = function() {
          LibComet.showHideFields([this.getAttribute("data-show")]);
        }
    }
  </script>

  <script>
    document.getElementById('upload_field').addEventListener('change', function(evt) {
      var file = document.getElementById('upload_field').files[0];

      if(window.FileReader) {
        //the browser does support the FileReader Object, so do this
        var reader  = new FileReader();
        reader.addEventListener("load", function () {
          insertResult(reader.result);
        }, false);
        if (file) {
          reader.readAsText(file);
        }
      } else {
        //the browser doesn't support the FileReader Object, so do this
        var formData = new FormData();
        formData.append('file', file);

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               insertResult(xhr.responseText);
            }
        };
        xhr.open('POST', '/api/corporas/corpus/upload', true);
        xhr.send(formData);

      }

    }, false);

    function insertResult(result){
        document.getElementById("campo").checked = true;
        document.getElementById('conteudo').value = result;
        document.getElementById('upload_field').value = '';
        LibComet.showHideFields(['#div_conteudo']);
    }

  </script>

@endsection
