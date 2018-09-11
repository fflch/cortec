<form method="POST" action="/corporas">
    {{ csrf_field() }}
    Nome: <input name="titulo">
    <button type="submit"> Salvar </button>
</form>
