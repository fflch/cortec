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
        <table class="table lista-palavras tbl-striped mx-3 table-borderless" id="tbl-lista-palavras">
          <thead>
            <tr class="row">
              <th class="text-center col-2">#</th>
              <th class="text-center col-10">{!! __('texts.concord.thead1') !!}</th>
            </tr>
          </thead>
          @php
            $i = 1;
          @endphp
          @foreach ($ocorrencias as $ocorrencia)
            <tr class="row align-middle">
              <td class="text-center align-self-center col-2" >
                {{$i}}
              </td>
              @php
                $ocorrencia[0] = str_replace ( '{{' , '<a data-toggle="collapse" href="#occrExp'.$i.'" role="button" aria-expanded="false" aria-controls="occrExp1">' , $ocorrencia[0]);
                $ocorrencia[0] = str_replace ( '}}' ,  '</a>' , $ocorrencia[0]);
              @endphp
              <td class="text-center col-10">
                {!! $ocorrencia[0] !!}
                <div class="collapse" id="occrExp{{$i}}">
                  <div class="card card-body">
                    <div class="card-text">
                      @php
                      $ocorrencia[1] = str_replace ( '{{' , '<strong>' , $ocorrencia[1]);
                      $ocorrencia[1] = str_replace ( '}}' ,  '</strong>' , $ocorrencia[1]);
                      @endphp
                      {!! $ocorrencia[1] !!}
                    </div>
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
