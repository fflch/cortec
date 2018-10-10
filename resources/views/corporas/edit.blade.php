@extends('master')

@section('content')
  <div class="row fluid">
    <div class="col">
      <a href="/corporas/{{ $corpora->id }}/corpus/"  class="btn btn-success">Listar Corpus</a>
      <a href="/corporas/{{ $corpora->id }}/corpus/create"  class="btn btn-success">Adicionar Corpus</a>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <form method="POST" action="/corporas/{{ $corpora->id  }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <div class="form-group mt-2">
          <label for="categoria_id">Categoria</label>
          <select name="categoria_id" class="custom-select">
            @php
              $sel = '';
            @endphp
            @foreach ($categorias as $categoria)
              @php
                if($categoria->id == $corpora->categoria_id){
                  $sel = 'selected';
                }else{
                  $sel = '';
                }
              @endphp
              <option value="{{$categoria->id}}" {{$sel}}>{{$categoria->nome}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="titulo">Nome</label>
          <input type="text" class="form-control" name="titulo" id="titulo" value="{{ $corpora->titulo }}">
        </div>
        <div class="form-group">
          <label for="descricao">Descrição</label>
          <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ $corpora->descricao }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
      </form>
    </div>
  </div>
@endsection
