@extends('master')

@section('content')
  <div class="row">

    <div class="col-md-6">
      <button type="button" name="button" onclick="sortTable()">sortTable</button>
      <table class="table" id="lista-palavras">
        <thead>
          <tr>
            <th scope="col">Pos.</th>
            <th scope="col" class="text-center">Palavra</th>
            <th scope="col" class="text-center">Freq.</th>
          </tr>
        </thead>
        <tbody>
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
        </tbody>
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

    // do the work...
    document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
        const table = th.closest('table');
        Array.from(table.querySelectorAll('tr:nth-child(n+2)'))
            .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
            .forEach(tr => table.appendChild(tr) );
    })));
  </script>
@endsection
