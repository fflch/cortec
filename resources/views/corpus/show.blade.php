@extends('master')
@section('content')
  <h1>{{ $corpus->titulo }}</h1>
  <p>{{ $corpus->descricao }}</p>
  <div class="row justify-content-md-center">
    <div class="col-xs-4">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">{{ $corpus->titulo }}</th>
            <th scope="col" class="text-center">Inglês</th>
            <th scope="col" class="text-center">Português</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Ocorrências/tokens</th>
            <td class="text-center"></td>
            <td class="text-center">{{$corpus->getAnalysis('count-tokens')}}</td>
          </tr>
          <tr>
            <th scope="row">Formas/types</th>
            <td class="text-center"></td>
            <td class="text-center">{{$corpus->getAnalysis('count-types')}}</td>
          </tr>
          <tr>
            <th scope="row">T/T ratio</th>
            <td class="text-center"></td>
            <td class="text-center">{{round($corpus->getAnalysis('count-tokens')/$corpus->getAnalysis('count-types'),2)}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
@endsection
