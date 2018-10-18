@extends('master')

@section('content')
  <div class="row">
    <div class="col">
      <form method="POST" action="/categorias">
        {{ csrf_field() }}
        <div class="form-group mt-2">
          <label for="titulo">Nome</label>
          <input type="text" class="form-control" name="nome" id="nome" value="">
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
      </form>
    </div>
  </div>
@endsection
