<?php

namespace App\Observers;

use App\Categoria;
use App\Change;
use Illuminate\Support\Facades\Auth;

class CategoriaObserver
{
    /**
     * Store the change in the database.
     *
     * @param  \App\Categoria  $categoria
     * @param  string  $operacao
     * @return void
     */
    private function storeChange(Categoria $categoria, string $operacao)
    {
        $change = new Change;

        $change->user_id       = Auth::user()->id;
        $change->entidade_id   = $categoria->id;
        $change->entidade_tipo = 'categoria';
        $change->entidade_nome = $categoria->nome;
        $change->operacao      = $operacao;

        $change->save();
    }

    /**
     * Handle the categoria "created" event.
     *
     * @param  \App\Categoria  $categoria
     * @return void
     */
    public function created(Categoria $categoria)
    {
        $this->storeChange($categoria, 'criado');
    }

    /**
     * Handle the categoria "updated" event.
     *
     * @param  \App\Categoria  $categoria
     * @return void
     */
    public function updated(Categoria $categoria)
    {
        $this->storeChange($categoria, 'modificado');
    }

    /**
     * Handle the categoria "deleted" event.
     *
     * @param  \App\Categoria  $categoria
     * @return void
     */
    public function deleted(Categoria $categoria)
    {
        $this->storeChange($categoria, 'removido');
    }
}
