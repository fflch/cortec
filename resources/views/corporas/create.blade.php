@extends('master')

@section('content')
  <form method="POST" action="/corporas">
      {{ csrf_field() }}
      Nome: <input name="titulo">
      <button class="btn btn-success" type="submit">Salvar</button>
  </form>
@endsection
