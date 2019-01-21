@extends('master')

@section('content')
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <table class="table lista-palavras tbl-striped mx-3 table-borderless" id="tbl-lista-palavras">
                    <thead>
                        <tr class="row">
                            <th class="text-center col">Usuário</th>
                            <th class="text-center col">ID da Entidade</th>
                            <th class="text-center col">Tipo de Entidade</th>
                            <th class="text-center col">Nome da Entidade</th>
                            <th class="text-center col">Operação</th>
                            <th class="text-center col">Data/Hora</th>
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
                                {{$change->entidade_tipo}}
                            </td>
                            <td class="col text-center align-self-center" >
                                {{$change->entidade_nome}}
                            </td>
                            <td class="col text-center align-self-center" >
                                {{$change->operacao}}
                            </td>
                            <td class="col text-center align-self-center" >
                                {{$change->created_at}}
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
