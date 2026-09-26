<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DemandeSessionModel extends Model
{
    protected $table = 'demande_sessions';

    public const STATUT_EN_ATTENTE = 'en_attente';
    public const STATUT_APPROUVEE  = 'approuvee';
    public const STATUT_REFUSEE    = 'refusee';

    protected $fillable = [
        'formateur_id',
        'filiere_id',
        'etablissement_id',
        'titre',
        'date_debut_souhaitee',
        'date_fin_souhaitee',
        'nb_places_souhaitees',
        'motif',
        'statut',
        'reponse_admin',
        'traitee_le',
    ];

    protected $casts = [
        'date_debut_souhaitee' => 'date',
        'date_fin_souhaitee'   => 'date',
        'traitee_le'           => 'datetime',
        'created_at'           => 'datetime',
        'updated_at'           => 'datetime',
    ];

    public function formateur(): BelongsTo
    {
        return $this->belongsTo(FormateurModel::class, 'formateur_id');
    }

    public function filiere(): BelongsTo
    {
        return $this->belongsTo(FiliereModel::class, 'filiere_id');
    }

    public function etablissement(): BelongsTo
    {
        return $this->belongsTo(EtablissementModel::class, 'etablissement_id');
    }

    public function estEnAttente(): bool
    {
        return $this->statut === self::STATUT_EN_ATTENTE;
    }

    public function estApprouvee(): bool
    {
        return $this->statut === self::STATUT_APPROUVEE;
    }

    public function estRefusee(): bool
    {
        return $this->statut === self::STATUT_REFUSEE;
    }
}