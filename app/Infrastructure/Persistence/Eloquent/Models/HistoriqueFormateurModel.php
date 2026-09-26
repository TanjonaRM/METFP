<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoriqueFormateurModel extends Model
{
    protected $table = 'historique_formateurs';

    public const TYPE_AFFECTATION    = 'affectation';
    public const TYPE_SESSION        = 'session';
    public const TYPE_ETABLISSEMENT  = 'etablissement';
    public const TYPE_FILIERE        = 'filiere';
    public const TYPE_STATUT         = 'statut';

    protected $fillable = [
        'formateur_id',
        'type',
        'entite_type',
        'entite_id',
        'valeur_avant',
        'valeur_apres',
        'details',
        'source',
        'survenu_le',
    ];

    protected $casts = [
        'details'    => 'array',
        'survenu_le' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELATIONS ====================

    public function formateur(): BelongsTo
    {
        return $this->belongsTo(FormateurModel::class, 'formateur_id');
    }

    // ==================== HELPERS ====================

    public function getIconeAttribute(): string
    {
        return match ($this->type) {
            self::TYPE_AFFECTATION   => 'assignment_ind',
            self::TYPE_SESSION       => 'event',
            self::TYPE_ETABLISSEMENT => 'apartment',
            self::TYPE_FILIERE       => 'school',
            self::TYPE_STATUT        => 'toggle_on',
            default                  => 'history',
        };
    }

    public function getCouleurAttribute(): string
    {
        return match ($this->type) {
            self::TYPE_AFFECTATION   => 'emerald',
            self::TYPE_SESSION       => 'blue',
            self::TYPE_ETABLISSEMENT => 'teal',
            self::TYPE_FILIERE       => 'amber',
            self::TYPE_STATUT        => 'violet',
            default                  => 'slate',
        };
    }

    public function getLibelleAttribute(): string
    {
        return match ($this->type) {
            self::TYPE_AFFECTATION   => 'Affectation',
            self::TYPE_SESSION       => 'Session',
            self::TYPE_ETABLISSEMENT => 'Établissement',
            self::TYPE_FILIERE       => 'Filière',
            self::TYPE_STATUT        => 'Statut',
            default                  => 'Événement',
        };
    }
}