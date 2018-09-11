<a href="/corporas/create">Criar Corpora</a>
<ul>
@foreach ($corporas as $corpora)
    <a href="/corporas/{{ $corpora->id }}"><li>{{ $corpora->titulo }} </li></a>
    <form method="POST" action="/corporas/{{ $corpora->id }}">
      {{ csrf_field() }}
      {{ method_field('delete') }}
      <button type="submit">Apagar</button>
    </form>
@endforeach
</ul>
