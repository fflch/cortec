@extends('master')

@section('content')
  <div class="container">
    <div class="row align-items-center ">
      <div class="col">
        <p>{!! __('texts.concord.texto1', ['count' => $ocorrencias->count()]) !!}</p>
        <p>{!! __('texts.concord.texto2') !!}</p>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col">
        <a href="/download/concord" target="_blank" class="btn btn-success">DOWNLOAD</a> {!! __('texts.concord.download1') !!}
      </div>
      <div class="col">
        <a href="/download/concord/?exp=1" target="_blank" class="btn btn-success">DOWNLOAD</a> {!! __('texts.concord.download2') !!}
      </div>
    </div>
  </div>
  <div class="container mt-3">
    <div class="row align-items-center">
      <div class="col">
        <table class="table lista-palavras tbl-striped mx-3" id="tbl-lista-palavras">
          <thead>
            <tr class="row">
              <th class="text-center col-2">#</th>
              <th class="text-center col-10">{!! __('texts.concord.thead1') !!}</th>
            </tr>
          </thead>
          @php
            $i = 1;
          @endphp
          @foreach ($ocorrencias->combine($ocorrencias_exp) as $ocorrencia => $ocorrencia_exp)
            <tr class="row align-middle">
              <td class="text-center align-self-center col-2" style="border-top: none;">
                {{$i}}
              </td>
              @php
                $ocorrencia = str_replace ( '{{' , '<a data-toggle="collapse" href="#occrExp'.$i.'" role="button" aria-expanded="false" aria-controls="occrExp1">' , $ocorrencia);
                $ocorrencia = str_replace ( '}}' ,  '</a>' , $ocorrencia);
              @endphp
              <td class="text-center col-10">
                {!! $ocorrencia !!}
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
