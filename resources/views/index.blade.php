@extends('master')

@section('content')
  <div class="container-lista">
    <div class="row">
      <h2>{!! __('texts.passo1.passo') !!}</h2>
    </div>
    <div class="row mt-10">
      <p>{!! __('texts.passo1.texto1') !!}</p>
    </div>
    <div class="row align-items-center row-header-lista px-1">
      <div class="col-xs-1 text-center">
        <h3 class="h3 h3-lista">{!! __('texts.passo1.lista') !!}</h3>
      </div>
    </div>
    <div class="row bg-gray" >
      <div class="col-lg-1-12">
        <ul class="corpora">
          @foreach ($corporas as $corpora)
              <form name="passo1" action="" method="post">
                <li class="corpora">
                  <input type="checkbox" name="{{ $corpora->titulo }}" value="{{ $corpora->titulo }}">
                  <a href="/corporas/{{ $corpora->id }}">{{ $corpora->titulo }}</a>
                </li>
              </form>
          @endforeach
        </ul>
      </div>
    </div>

    <div class="row align-items-center row-header-lista mt-4 px-1">
      <div class="col-xs-1 text-center">
        <h3 class="h3 h3-lista">{!! __('texts.passo1.lingua') !!}</h3>
      </div>
    </div>
    <div class="row bg-gray">
      <div class="col-lg-1-12">
        <ul class="corpora">
          <li class="corpora">
            <input type="radio" name="check_lingua" value="portugues" checked="">{!! __('texts.passo1.lingua1') !!}
          </li>
            <input type="radio" name="check_lingua" value="ingles" checked="">{!! __('texts.passo1.lingua2') !!}
          </li>
        </ul>
      </div>
    </div>

  </div>
@endsection
