<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FiliereModel extends Model
{
    protected $table = 'filieres';

    public const STATUT_ACTIF    = 'actif';
    public const STATUT_INACTIF  = 'inactif';
    public const STATUT_SUSPENDU = 'suspendu';

    public const STATUTS = [
        self::STATUT_ACTIF,
        self::STATUT_INACTIF,
        self::STATUT_SUSPENDU,
    ];

    protected $fillable = [
        'code', 'libelle', 'niveau_id', 'secteur_id', 'description', 'statut',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELATIONS ====================

    public function niveau(): BelongsTo
    {
        return $this->belongsTo(NiveauModel::class, 'niveau_id');
    }

    public function secteur(): BelongsTo
    {
        return $this->belongsTo(SecteurModel::class, 'secteur_id');
    }

    public function options(): HasMany
    {
        return $this->hasMany(FiliereOptionModel::class, 'filiere_id');
    }

    /**
     * Formateurs dans cette filière (1-N depuis ajout formateurs.filiere_id)
     */
    public function formateurs(): HasMany
    {
        return $this->hasMany(FormateurModel::class, 'filiere_id');
    }

    public function affectations(): HasMany
    {
        return $this->hasMany(AffectationModel::class, 'filiere_id');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(SessionModel::class, 'filiere_id');
    }

    // ==================== SCOPES ====================

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;
        return $query->where(function ($q) use ($term) {
            $q->where('code', 'like', "%{$term}%")
              ->orWhere('libelle', 'like', "%{$term}%");
        });
    }

    public function scopeActif($query)
    {
        return $query->where('statut', self::STATUT_ACTIF);
    }
}