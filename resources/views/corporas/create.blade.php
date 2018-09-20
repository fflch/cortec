@extends('master')

@section('content')
  <form method="POST" action="/corporas">
      {{ csrf_field() }}
      Nome: <input name="titulo" required>
      Descrição: <input name="descricao" required>
      <button class="btn btn-success" type="submit">Salvar</button>
  </form>
@endsection
