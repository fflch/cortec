@extends('master')

@section('content')
  @php
    $i = 1;
  @endphp
  @foreach ($corporas as $corpora)
    <div class="row">
      <a href="#{{ $corpora->id }}">{{$i}}. {{ $corpora->titulo }}</a>
    </div>
  @php
    $i++;
  @endphp
  @endforeach

  @php
    $i = 1;
  @endphp
  @foreach ($corporas as $corpora)
    <a name="{{ $corpora->id }}"></a>
    <div class="row">
      <h3>{{$i}} - {{ $corpora->titulo }}</h3>
    </div>
    <div class="row">
      <p>{{ $corpora->descricao }}</p>
    </div>
    @php
      $i++;
    @endphp
  @endforeach
@endsection
