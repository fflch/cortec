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

    <div class="row justify-content-md-center">
      <div class="col-xs-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">{{ $corpora->titulo }}</th>
              <th scope="col" class="text-center">Inglês</th>
              <th scope="col" class="text-center">Português</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Ocorrências/tokens</th>
              <td class="text-center">{{count($corpora->countTokens())}}</td>
              <td class="text-center">{{count($corpora->countTokens())}}</td>
            </tr>
            <tr>
              <th scope="row">Formas/types</th>
              <td class="text-center"></td>
              <td class="text-center"></td>
            </tr>
            <tr>
              <th scope="row">T/T ratio</th>
              <td class="text-center"></td>
              <td class="text-center"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  @endforeach
@endsection
