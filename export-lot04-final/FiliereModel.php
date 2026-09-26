<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FiliereModel extends Model
{
    protected $table = 'filieres';

    protected $fillable = [
        'code',
        'libelle',
        'niveau_id',
        'secteur_id',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELATIONS ====================

    /**
     * Niveau (optionnel — nullable depuis suppression UI)
     */
    public function niveau(): BelongsTo
    {
        return $this->belongsTo(NiveauModel::class, 'niveau_id');
    }

    /**
     * Secteur (optionnel — nullable depuis suppression UI)
     */
    public function secteur(): BelongsTo
    {
        return $this->belongsTo(SecteurModel::class, 'secteur_id');
    }

    /**
     * Options de la filière
     */
    public function options(): HasMany
    {
        return $this->hasMany(FiliereOptionModel::class, 'filiere_id');
    }

    /**
     * Formateurs liés à cette filière (via table pivot)
     */
    public function formateurs(): BelongsToMany
    {
        return $this->belongsToMany(
            FormateurModel::class,
            'formateur_filieres',
            'filiere_id',
            'formateur_id'
        )->withTimestamps();
    }

    /**
     * Affectations liées à cette filière
     */
    public function affectations(): HasMany
    {
        return $this->hasMany(AffectationModel::class, 'filiere_id');
    }

    /**
     * Sessions liées à cette filière
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(SessionModel::class, 'filiere_id');
    }

    // ==================== SCOPES ====================

    /**
     * Recherche par code ou libellé
     */
    public function scopeSearch($query, ?string $term)
    {
        if (!$term) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('code', 'like', "%{$term}%")
              ->orWhere('libelle', 'like', "%{$term}%");
        });
    }
}