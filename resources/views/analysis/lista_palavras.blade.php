@extends('master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-xl-6">
            <table class="table lista-palavras" id="tbl-lista-palavras">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" colspan="2">{!! __('texts.lista_palavras.tabela.head1') !!}</th>
                    </tr>
                </thead>
                <tr>
                    <td class="">{!! __('texts.lista_palavras.tabela.total1') !!}</td>
                    <td class="text-center">{{$analysis['count-tokens'] ?? 0}}</td>
                </tr>
                <tr>
                    <td class="">{!! __('texts.lista_palavras.tabela.total2') !!}</td>
                    <td class="text-center">{{$analysis['count-types'] ?? 0}}</td>
                </tr>
                <tr>
                    <td class="">{!! __('texts.lista_palavras.tabela.header1') !!}</td>
                    <td class="text-center">{{$analysis['count-once-tokens'] ?? 0}}</td>
                </tr>
                <tr>
                    <td class="">{!! __('texts.lista_palavras.tabela.header2') !!}</td>
                    <td class="text-center">{{$analysis['count-types'] - $analysis['count-once-tokens'] ?? 0}}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-xl-6">
            <table class="table lista-palavras" id="tbl-lista-palavras">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" colspan="2">{!! __('texts.lista_palavras.tabela.head2') !!}</th>
                    </tr>
                </thead>
                <tr>
                    <td class="text-center">{!! __('texts.lista_palavras.tabela.ratio') !!}</td>
                    <td class="text-center">{{$analysis['ratio']}}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row mb-2 justify-content-between">
        <div class="col">
            <h2>{!! __('texts.lista_palavras.tabela.head3') !!}</h2>
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
                        <th scope="col" data-sort class="text-center">{!! __('texts.lista_palavras.tabela.header2_2') !!} <i class="fas fa-sort"></i></th>
                        <th scope="col" data-sort class="text-center">{!! __('texts.lista_palavras.tabela.header2_3') !!} <i class="fas fa-sort"></i></th>
                    </tr>
                </thead>
                @php
                $i = 1;
                @endphp
                @foreach ($analysis['frequency-tokens'] as $word => $count)
                    <tr>
                        <td class="text-center">{{$i}}</td>
                        <td class="text-center">{{$word}}</td>
                        <td class="text-center">{{$count}}</td>
                    </tr>
                    @php
                    $i++;
                    @endphp
                @endforeach
            </table>
        </div>
    </div>
@endsection



@section('javascripts')
    @parent
    <script type="text/javascript" src="{{ asset('/js/analise/analise_lista_palavras.js') }}"></script>
@endsection
