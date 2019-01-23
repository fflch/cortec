<?php

namespace App\Observers;

use App\Text;
use App\Change;
use Illuminate\Support\Facades\Auth;

class TextObserver
{
    /**
     * Store the change in the database.
     *
     * @param  \App\Text  $text
     * @param  string  $operacao
     * @return void
     */
    private function storeChange(Text $text, string $operacao)
    {
        $change = new Change;

        $change->user_id       = Auth::user()->id;
        $change->entidade_id   = $text->id;
        $change->entidade_tipo = 'text';
        $change->entidade_nome = '';
        $change->operacao      = $operacao;

        $change->save();
    }

    /**
     * Handle the text "created" event.
     *
     * @param  \App\Text  $text
     * @return void
     */
    public function created(Text $text)
    {
        $this->storeChange($text, 'criado');
    }

    /**
     * Handle the text "updated" event.
     *
     * @param  \App\Text  $text
     * @return void
     */
    public function updated(Text $text)
    {
        $this->storeChange($text, 'modificado');
    }

    /**
     * Handle the text "deleted" event.
     *
     * @param  \App\Text  $text
     * @return void
     */
    public function deleted(Text $text)
    {
        $this->storeChange($text, 'removido');
    }

}
