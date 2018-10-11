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

    <form name="passo1" action="" method="post">
      <div class="row bg-gray pb-4" >
        @foreach ($categorias as $categoria)
          <div class="col-sm-3 mt-2">
            <div class="card">
              <label for="check_cat_{{$categoria->id}}" style="margin-bottom: 0;">
                <div class="card-header list-group-item-action">
                  <input type="checkbox" id="check_cat_{{$categoria->id}}" value="{{$categoria->id}}">
                  {{$categoria->nome}}
                </div>
              </label>
              <ul class="list-group list-group-flush" id="list_corp">
                @foreach ($categoria->corporas as $corpora)
                  <label for="check_{{$categoria->id}}_{{$corpora->id}}" style="margin-bottom: 0;">
                    <li class="list-group-item list-group-item-action">
                    <input type="checkbox" name="{{ $corpora->titulo }}" value="{{ $corpora->titulo }}" id="check_{{$categoria->id}}_{{$corpora->id}}">
                      <a href="/corporas/{{ $corpora->id }}">
                        {{ $corpora->titulo }}
                      </a>
                    </li>
                  </label>
                @endforeach
              </ul>
            </div>
          </div>
        @endforeach
      </div>
    </form>

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

@section('javascripts')
  <script>

    checks_cats = Array.from(document.querySelectorAll('[id^="check_cat_"]'));

    checks_cats.map(function (elm){
      checks_corps = Array.from(document.querySelectorAll('[id^="check_'+elm.value+'_"]'));

      checks_corps.map(function (elm_corp){
        elm_corp.onclick = function (elmcorp){
          checks_corps = Array.from(document.querySelectorAll('[id^="check_'+elm.value+'_"]'));
          var checkedCount = document.querySelectorAll('[id^="check_'+elm.value+'_"]:checked').length;

          (checkedCount > 0 & checkedCount < checks_corps.length) ? (elm.indeterminate = true) : (elm.indeterminate = false);
          elm.checked = !(checkedCount == 0);
        }
      });

      elm.onclick = function () {
        checks_corps = Array.from(document.querySelectorAll('[id^="check_'+elm.value+'_"]'));
        checks_corps.map(function (elm_corp){
          elm_corp.checked = elm.checked;
        });
      }

    });

  </script>

@endsection
