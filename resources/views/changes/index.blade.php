@extends('master')

@section('content')
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <table class="table lista-palavras tbl-striped mx-3 table-borderless" id="tbl-lista-palavras">
                    <thead>
                        <tr class="row">
                            <th class="text-center col">{{__('texts.changes.usuario')}}</th>
                            <th class="text-center col">{{__('texts.changes.entidade_id')}}</th>
                            <th class="text-center col">{{__('texts.changes.entidade_tipo')}}</th>
                            <th class="text-center col">{{__('texts.changes.entidade_nome')}}</th>
                            <th class="text-center col">{{__('texts.changes.operacao')}}</th>
                            <th class="text-center col">{{__('texts.changes.data')}}</th>
                        </tr>
                    </thead>
                    @foreach ($changes as $change)
                        <tr class="row align-middle">
                            <td class="col text-center align-self-center" >
                                {{$change->user->name}}
                            </td>
                            <td class="col text-center align-self-center" >
                                {{$change->entidade_id}}
                            </td>
                            <td class="col text-center align-self-center" >
                                {{__('texts.changes.'.$change->entidade_tipo)}}
                            </td>
                            <td class="col text-center align-self-center" >
                                {{$change->entidade_nome}}
                            </td>
                            <td class="col text-center align-self-center" >
                                {{__('texts.changes.'.$change->operacao)}}
                            </td>
                            <td class="col text-center align-self-center" >
                                {{$change->created_at->format('d/m/Y G:i:s')}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection


@section('javascripts')
  @parent
  <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
@endsection
