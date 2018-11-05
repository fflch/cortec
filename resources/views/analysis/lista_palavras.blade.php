@extends('master')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <table class="table lista-palavras" id="tbl-lista-palavras">
        <thead>
          <tr>
            <th scope="col" class="text-center" colspan="2">Ocorrências (tokens)</th>
          </tr>
        </thead>
          <tr>
            <td class="text-center">Total de Ocorrências</td>
            <td class="text-center">{{$analysis['count-tokens']}}</td>
          </tr>
          <tr>
            <td class="text-center">Total de Ocorrências que aparecem uma vez</td>
            <td class="text-center">{{null}}</td>
          </tr>
          <tr>
            <td class="text-center">Total de Ocorrências que aparecem mais de uma vez</td>
            <td class="text-center">{{null}}</td>
          </tr>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <table class="table lista-palavras" id="tbl-lista-palavras">
        <thead>
          <tr>
            <th scope="col" class="text-center" colspan="2">Palavras únicas/formas (types)</th>
          </tr>
        </thead>
          <tr>
            <td class="text-center">Total de Palavras</td>
            <td class="text-center">{{$analysis['count-types']}}</td>
          </tr>
          <tr>
            <td class="text-center">Total de Palavras que aparecem uma vez</td>
            <td class="text-center">{{null}}</td>
          </tr>
          <tr>
            <td class="text-center">Total de Palavras que aparecem mais de uma vez</td>
            <td class="text-center">{{null}}</td>
          </tr>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <table class="table lista-palavras" id="tbl-lista-palavras">
        <thead>
          <tr>
            <th scope="col" class="text-center" colspan="2">Índice Vocabular (token/type ratio)</th>
          </tr>
        </thead>
          <tr>
            <td class="text-center">Token/Type</td>
            <td class="text-center">{{$analysis['ratio']}}</td>
          </tr>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <table class="table lista-palavras" id="tbl-lista-palavras">
        <thead>
          <tr>
            <th scope="col" data-sort class="text-center">Pos. <i class="fas fa-sort"></i></th>
            <th scope="col" data-sort class="text-center">Palavra <i class="fas fa-sort"></i></th>
            <th scope="col" data-sort class="text-center">Freq. <i class="fas fa-sort"></i></th>
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
  <script>
    const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;
    const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
        v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
        )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

    document.querySelectorAll('th[data-sort]').forEach(th => th.addEventListener('click', (() => {
      const table = th.closest('table').tBodies[0];
      table.parentElement.style.cursor = 'progress';
      setTimeout(function(){ sortTable(th, table); table.parentElement.style.cursor = ''; }, 400);
    })));

    function sortTable(th, table){
      return new Promise(function(resolve, reject) {
        Array.from(table.querySelectorAll('tr:nth-child(n+1)'))
            .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
            .forEach(tr => table.appendChild(tr) );
        resolve();
        });
    }

  </script>
@endsection
