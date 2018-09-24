@extends('master')

@section('content')
  <h1>{{ $corpora->titulo }}</h1>
  <p>{{ $corpora->descricao }}</p>
  <a href="/corporas/{{ $corpora->id }}/edit"> Editar </a>
  <a href="/corporas/{{ $corpora->id }}/corpus/create"> Adicionar Corpus </a>
@endsection
