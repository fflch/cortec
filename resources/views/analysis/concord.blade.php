@extends('master')

@section('content')
  <div class="container">
    <div class="row align-items-center ">
      <div class="col">
        <p>Foram encontradas {{$ocorrencias->count()}} ocorrências!!</p>
        <p>Clique na palavra de busca para obter um contexto expandido com 150 caracteres</p>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col">
        <a href="/download/concord" target="_blank" class="btn btn-success">DOWNLOAD</a> com contexto reduzido
      </div>
      <div class="col">
        <a href="/download/concord/?exp=1" target="_blank" class="btn btn-success">DOWNLOAD</a> com contexto expandido
      </div>
    </div>
    <div class="row align-items-center mt-3">
      <div class="col">
        <table class="table lista-palavras" id="tbl-lista-palavras">
          <thead>
            <th class="text-center">#</th>
            <th class="text-center">Ocorrência</th>
          </thead>
          @php
            $i = 1;
          @endphp
          @foreach ($ocorrencias->combine($ocorrencias_exp) as $ocorrencia => $ocorrencia_exp)
            <tr class="ocrr">
              <td class="text-center">{{$i}}</td>
              @php
                $ocorrencia = str_replace ( '{{' , '<a data-toggle="collapse" href="#occrExp'.$i.'" role="button" aria-expanded="false" aria-controls="occrExp1">' , $ocorrencia);
                $ocorrencia = str_replace ( '}}' ,  '</a>' , $ocorrencia);
              @endphp
              <td class="text-center">{!! $ocorrencia !!}</td>
            </tr>
            <tr>
              <td colspan="2">
                <div class="collapse" id="occrExp{{$i}}">
                  <div class="card card-body">
                    @php
                      $ocorrencia_exp = str_replace ( '{{' , '<b>' , $ocorrencia_exp);
                      $ocorrencia_exp = str_replace ( '}}' ,  '</b>' , $ocorrencia_exp);
                    @endphp
                    {!! $ocorrencia_exp !!}
                  </div>
                </div>
              </td>
            </tr>
            @php
              $i++;
            @endphp
          @endforeach
        </table>
      </div>
    </div>
  </div>
@endsection



@section('javascripts')
  @parent
  <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/corpuses/analise_lista_palavras.js') }}"></script>
@endsection
