@extends('laravel-comet-theme::master')

@section('content')
  <form method="POST" action="/corporas">
      {{ csrf_field() }}
      Nome: <input name="titulo">
      <button type="submit"> Salvar </button>
  </form>
@endsection
