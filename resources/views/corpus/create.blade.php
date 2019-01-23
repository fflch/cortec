@extends('master')

@section('content')
  <form method="POST" action="/corpus">
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
        <input type="text" class="form-control" name="titulo" id="titulo" required placeholder="Ex.: Turismo">
      </div>
      <div class="form-group">
        <label for="descricao">Descrição</label>
        <textarea class="form-control" id="descricao" name="descricao" required rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="tipologia">Tipologia Textual</label>
        <input type="text" class="form-control" name="tipologia" id="tipologia" required placeholder="Ex.: Não-literário informativo">
      </div>
      <div class="form-group">
        <label for="compilador">Compilador</label>
        <input type="text" class="form-control" name="compilador" id="compilador" required placeholder="Ex.: Henry Kučera">
      </div>
      <div class="form-group">
        <label for="ano">Ano</label>
        <input type="number" class="form-control" name="ano" id="ano" min="1500" max="2150" required placeholder="Ex.: 2018">
      </div>
      <button type="submit" class="btn btn-success">Salvar</button>
  </form>
@endsection
