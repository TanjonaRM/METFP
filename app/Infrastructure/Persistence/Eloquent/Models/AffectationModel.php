<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffectationModel extends Model
{
    use HasFactory;

    protected $table = 'affectations';

    public const STATUT_ACTIF    = 'actif';
    public const STATUT_INACTIF  = 'inactif';
    public const STATUT_SUSPENDU = 'suspendu';

    public const STATUTS = [
        self::STATUT_ACTIF,
        self::STATUT_INACTIF,
        self::STATUT_SUSPENDU,
    ];

    protected $fillable = [
        'formateur_id', 'filiere_id', 'etablissement_id',
        'date_debut', 'date_fin', 'statut',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin'   => 'date',
    ];

    public function formateur()
    {
        return $this->belongsTo(FormateurModel::class, 'formateur_id');
    }

    public function filiere()
    {
        return $this->belongsTo(FiliereModel::class, 'filiere_id');
    }

    public function etablissement()
    {
        return $this->belongsTo(EtablissementModel::class, 'etablissement_id');
    }

    public function estActive(): bool
    {
        return $this->statut === self::STATUT_ACTIF;
    }

    public function estInactive(): bool
    {
        return $this->statut === self::STATUT_INACTIF;
    }

    public function estSuspendue(): bool
    {
        return $this->statut === self::STATUT_SUSPENDU;
    }
}