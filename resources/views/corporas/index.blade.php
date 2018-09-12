@extends('laravel-comet-theme::master')

@section('content')
  <a href="/corporas/create">Criar Corpora</a>
  <ul>
    @foreach ($corporas as $corpora)
        <form name="passo1" action="" method="post">
          <li>
            <input type="checkbox" name="{{ $corpora->titulo }}" value="{{ $corpora->titulo }}" onchange="somacont(this)" onuncheck="subcont()">
            <a href="/corporas/{{ $corpora->id }}">{{ $corpora->titulo }}</a>
          </li>
        </form>

        <form method="POST" action="/corporas/{{ $corpora->id }}">
          {{ csrf_field() }}
          {{ method_field('delete') }}
          <button type="submit">Apagar</button>
        </form>
    @endforeach
  </ul>
@endsection
