<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EtablissementModel extends Model
{
    protected $table = 'etablissements';

    public const STATUT_ACTIF    = 'actif';
    public const STATUT_INACTIF  = 'inactif';
    public const STATUT_SUSPENDU = 'suspendu';

    public const STATUTS = [
        self::STATUT_ACTIF,
        self::STATUT_INACTIF,
        self::STATUT_SUSPENDU,
    ];

    protected $fillable = [
        'code', 'nom', 'type', 'region', 'adresse',
        'telephone', 'contact_responsable', 'email', 'statut',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELATIONS ====================

    public function formateurs(): HasMany
    {
        return $this->hasMany(FormateurModel::class, 'etablissement_id');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(SessionModel::class, 'etablissement_id');
    }

    public function affectations(): HasMany
    {
        return $this->hasMany(AffectationModel::class, 'etablissement_id');
    }

    // ==================== SCOPES ====================

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;
        return $query->where(function ($q) use ($term) {
            $q->where('code', 'like', "%{$term}%")
              ->orWhere('nom', 'like', "%{$term}%")
              ->orWhere('region', 'like', "%{$term}%")
              ->orWhere('adresse', 'like', "%{$term}%")
              ->orWhere('contact_responsable', 'like', "%{$term}%")
              ->orWhere('telephone', 'like', "%{$term}%")
              ->orWhere('email', 'like', "%{$term}%");
        });
    }

    public function scopeActif($query)
    {
        return $query->where('statut', self::STATUT_ACTIF);
    }

    // ==================== ACCESSORS ====================

    public function getContactAttribute(): ?string
    {
        return $this->contact_responsable ?? $this->telephone;
    }
}