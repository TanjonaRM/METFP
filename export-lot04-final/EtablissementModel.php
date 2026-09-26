<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EtablissementModel extends Model
{
    protected $table = 'etablissements';

    protected $fillable = [
        'code',
        'nom',
        'type',
        'region',
        'adresse',
        'telephone',             // ancien champ conservé pour compatibilité
        'contact_responsable',   // nouveau champ
        'email',
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

    /**
     * Recherche multi-champs
     */
    public function scopeSearch($query, ?string $term)
    {
        if (!$term) {
            return $query;
        }

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

    // ==================== ACCESSORS ====================

    /**
     * Retourne le contact responsable (nouveau champ ou fallback téléphone)
     */
    public function getContactAttribute(): ?string
    {
        return $this->contact_responsable ?? $this->telephone;
    }
}