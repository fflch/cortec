@extends('master')

@section('content')
  <form method="POST" action="/corporas/{{ $corpora_id }}/corpus">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="conteudo">Conteúdo</label>
        <textarea class="form-control" id="conteudo" name="conteudo" rows="5"></textarea>
      </div>
      <button type="submit" class="btn btn-success">Salvar</button>
  </form>
@endsection
