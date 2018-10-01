@extends('master')
@section('content')
  <h1>{{ $corpora->titulo }}</h1>
  <p>{{ $corpora->descricao }}</p>
  <h2>Contagem de Tokens</h2>
  @foreach ($corpora->countTokens() as $token => $count)
    <div class="row">
      <div class="col">
        {{$token}}
      </div>
      <div class="col">
        {{$count}}
      </div>
    </div>
  @endforeach
@endsection
