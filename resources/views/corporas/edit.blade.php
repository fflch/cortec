@extends('master')

@section('content')
  <form method="POST" action="/corporas/{{ $corpora->id  }}">
      {{ csrf_field() }}
      {{ method_field('patch') }}
      Nome: <input name="titulo" value="{{ $corpora->titulo }}">
      <button type="submit"> Salvar </button>
  </form>
@endsection
