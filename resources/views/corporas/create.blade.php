@extends('master')

@section('content')
  <form method="POST" action="/corporas">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="categoria_id">Categoria</label>
        <select name="categoria_id" class="custom-select">
          @foreach ($categorias as $categoria)
            <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="titulo">Nome</label>
        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Ex.: Turismo">
      </div>
      <div class="form-group">
        <label for="descricao">Descrição</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-success">Salvar</button>
  </form>
@endsection
