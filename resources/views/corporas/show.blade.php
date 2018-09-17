@extends('master')

@section('content')
  <h1>{{ $corpora->titulo }}</h1>
  <a href="/corporas/{{ $corpora->id }}/edit"> Editar </a>
@endsection
