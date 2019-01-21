<?php

namespace App\Observers;

use App\Corpus;
use App\Change;
use Illuminate\Support\Facades\Auth;

class CorpusObserver
{
    /**
     * Store the change in the database.
     *
     * @param  \App\Corpus  $corpus
     * @param  string  $operacao
     * @return void
     */
    private function storeChange(Corpus $corpus, string $operacao)
    {
        $change = new Change;

        $change->user_id       = Auth::user()->id;
        $change->entidade_id   = $corpus->id;
        $change->entidade_tipo = 'corpus';
        $change->entidade_nome = $corpus->titulo;
        $change->operacao      = $operacao;

        $change->save();
    }

    /**
     * Handle the corpus "created" event.
     *
     * @param  \App\Corpus  $corpus
     * @return void
     */
    public function created(Corpus $corpus)
    {
        $this->storeChange($corpus, 'criado');
    }

    /**
     * Handle the corpus "updated" event.
     *
     * @param  \App\Corpus  $corpus
     * @return void
     */
    public function updated(Corpus $corpus)
    {
        $this->storeChange($corpus, 'modificado');
    }

    /**
     * Handle the corpus "deleted" event.
     *
     * @param  \App\Corpus  $corpus
     * @return void
     */
    public function deleted(Corpus $corpus)
    {
        $this->storeChange($corpus, 'removido');
    }
}
