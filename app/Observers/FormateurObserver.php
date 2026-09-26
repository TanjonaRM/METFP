<?php

namespace App\Observers;

use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class FormateurObserver
{
    /**
     * Quand le statut du formateur change -> propager partout.
     */
    public function updated(FormateurModel $formateur): void
    {
        if ($formateur->wasChanged('statut')) {
            $formateur->propagerStatut();
        }
    }

    /**
     * Quand un formateur est créé -> propager son statut initial.
     */
    public function created(FormateurModel $formateur): void
    {
        // Pas besoin de propager à la création (pas d'entités liées)
    }
}