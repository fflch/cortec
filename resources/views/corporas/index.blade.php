<a href="/corporas/create">Criar Corpora</a>
<ul>
@foreach ($corporas as $corpora)
    <a href="/corporas/{{ $corpora->id }}"><li>{{ $corpora->titulo }} </li></a>
@endforeach
</ul>
