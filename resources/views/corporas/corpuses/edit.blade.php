@extends('master')

@section('content')
  <form method="POST" name="corpus" action="/corporas/{{ $corpora->id }}/corpus/{{ $corpus->id }}">
      {{ csrf_field() }}

      <div class="form-group" id="div_conteudo">
        <label for="conteudo">Conteúdo</label>
        <textarea class="form-control" id="conteudo" name="conteudo" rows="5">{{ $corpus->conteudo }}</textarea>
      </div>

      <button type="submit" class="btn btn-success">Salvar</button>
  </form>
@endsection
