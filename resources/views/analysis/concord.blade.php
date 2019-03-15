@extends('master')

@section('content')
  <div class="container-fluid">
      <div class="row mb-3">
          <div class="col">
              <h2>Concordanciador</h2>
          </div>
      </div>
    <div class="row justify-content-between">
      <div class="col-12 col-sm-6">
        <p>{!! __('texts.concord.texto1', ['count' => $ocorrencias->count()]) !!}</p>
        <p>{!! __('texts.concord.texto2') !!}</p>
      </div>
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="row">
          <div class="col">
              <a href="/download/concord" target="_blank" class="btn btn-success">DOWNLOAD</a> {!! __('texts.concord.download1') !!}
          </div>
        </div>
          <div class="row mt-2">
            <div class="col">
                <a href="/download/concord/?exp=1" target="_blank" class="btn btn-success">DOWNLOAD</a> {!! __('texts.concord.download2') !!}
            </div>
          </div>
      </div>
    </div>
  </div>
  <div class="container-fluid d-flex justify-content-center mt-3">
    <div class="row">
      <div class="col">
        <table class="table table-responsive lista-palavras tbl-striped table-borderless" id="tbl-lista-palavras">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">{!! __('texts.concord.thead1') !!}</th>
            </tr>
          </thead>
          @php
            $i = 1;
          @endphp
          @foreach ($ocorrencias as $ocorrencia)
            <tr class="align-middle">
              <td class="text-center align-self-center">
                {{$i}}
              </td>
              @php
                $ocorrencia[0] = str_replace ( '{{' , '<a data-toggle="collapse" href="#occrExp'.$i.'" role="button" aria-expanded="false" aria-controls="occrExp1">' , $ocorrencia[0]);
                $ocorrencia[0] = str_replace ( '}}' ,  '</a>' , $ocorrencia[0]);
              @endphp
              <td class="text-monospace" id="td_occrExp{{$i}}">
                   &nbsp;{!! $ocorrencia[0] !!}
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
  <script type="text/javascript" src="{{ asset('/js/analise/analise_lista_palavras.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/analise/analise_concord.js') }}"></script>
@endsection
