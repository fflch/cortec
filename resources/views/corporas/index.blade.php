@extends('laravel-comet-theme::master')

@section('content')
  <div class="container-lista">
    <div class="row">
      <h2>Passo 1/3: Escolhendo os Corpora.</h2>
    </div>
    <div class="row mt-10">
      <p>Abaixo estão listados os corpora que compõem o CorTec.<br>Selecione os corpora que deseja pesquisar:</p>
    </div>
    <div class="row align-items-center row-header-lista">
      <div class="col-xs-1 text-center">
        <h3 class="h3 h3-lista">Lista de Corpora</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-1-12">
        <ul class="corpora">
          @foreach ($corporas as $corpora)
              <form name="passo1" action="" method="post">
                <li class="corpora">
                  <input type="checkbox" name="{{ $corpora->titulo }}" value="{{ $corpora->titulo }}" onchange="somacont(this)" onuncheck="subcont()">
                  <a href="/corporas/{{ $corpora->id }}">{{ $corpora->titulo }}</a>
                  <form method="POST" action="/corporas/{{ $corpora->id }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger">Apagar</button>
                  </form>
                </li>
              </form>
          @endforeach
        </ul>
      </div>
    </div>

    <div class="row align-items-center row-header-lista">
      <div class="col-xs-1 text-center">
        <h3 class="h3 h3-lista">Língua</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-1-12">
        <ul class="corpora">
          <li class="corpora">
            <input type="radio" name="check_lingua" value="portugues" checked="">Português
          </li>
            <input type="radio" name="check_lingua" value="ingles" checked="">Inglês
          </li>
        </ul>
      </div>
    </div>

  </div>
@endsection
