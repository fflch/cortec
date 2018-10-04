@extends('master')
@section('content')
  <h1>{{ $corpora->titulo }}</h1>
  <p>{{ $corpora->descricao }}</p>
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
            <td class="text-center"></td>
            <td class="text-center">{{$corpora->getTokensCount()}}</td>
          </tr>
          <tr>
            <th scope="row">Formas/types</th>
            <td class="text-center"></td>
            <td class="text-center">{{$corpora->getTypesCount()}}</td>
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
@endsection
