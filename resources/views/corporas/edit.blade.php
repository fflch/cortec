@extends('master')

@section('content')
  <form method="POST" action="/corporas/{{ $corpora->id  }}">
      {{ csrf_field() }}
      {{ method_field('patch') }}
      <div class="form-group">
        <label for="titulo">Nome</label>
        <input type="text" class="form-control" name="titulo" id="titulo" value="{{ $corpora->titulo }}">
      </div>
      <div class="form-group">
        <label for="descricao">Descrição</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ $corpora->descricao }}</textarea>
      </div>
      <button type="submit" class="btn btn-success">Salvar</button>
  </form>
@endsection
