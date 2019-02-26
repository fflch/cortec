@extends('master')

@section('content')
    <div class="row mb-2 justify-content-between">
        <div class="col">
            <h2>Tabela de N-gramas</h2>
        </div>
        <div class="col text-right">
            <a href="/download/frequencia" target="_blank" class="btn btn-success">{!! __('texts.lista_palavras.tabela.download') !!}</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table lista-palavras tbl-striped" id="tbl-lista-palavras">
                <thead>
                    <tr style="cursor: pointer;">
                        <th scope="col" data-sort class="text-center">{!! __('texts.lista_palavras.tabela.header2_1') !!} <i class="fas fa-sort"></i></th>
                        <th scope="col" data-sort class="text-center">N-grama <i class="fas fa-sort"></i></th>
                        @if ($stats)
                            <th scope="col" data-sort class="text-center">Probabilidade de associação</th>
                        @else
                            <th scope="col" data-sort class="text-center">Frequência<i class="fas fa-sort"></i></th>
                        @endif
                    </tr>
                </thead>
                @php
                    $i = 1;
                    $old_value = 0;
                @endphp
                @foreach ($ngrams as $ngram => $raw_value)
                    @php
                        $value = ($stats) ? round($raw_value, 4) : $raw_value[0];
                        ($old_value > $value) ? $i++ : $i;
                        $old_value = $value;
                    @endphp
                    <tr>
                        <td class="text-center">{{$i}}</td>
                        <td class="text-center">{{$ngram}}</td>
                        <td class="text-center">{{$value}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection



@section('javascripts')
    @parent
    <script type="text/javascript" src="{{ asset('/js/analise/analise_lista_palavras.js') }}"></script>
@endsection
