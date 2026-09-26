<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffectationModel extends Model
{
    use HasFactory;

    protected $table = 'affectations';

    protected $fillable = [
        'formateur_id', 'filiere_id', 'etablissement_id',
        'date_debut', 'date_fin', 'statut',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
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
        return $this->statut === 'actif';
    }

    public function estTerminee(): bool
    {
        return $this->statut === 'termine';
    }

    public function estSuspendue(): bool
    {
        return $this->statut === 'suspendu';
    }
}