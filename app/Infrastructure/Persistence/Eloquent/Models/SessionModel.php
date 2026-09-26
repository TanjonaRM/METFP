<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionModel extends Model
{
    protected $table = 'formations_sessions';

    public const STATUT_ACTIF    = 'actif';
    public const STATUT_INACTIF  = 'inactif';
    public const STATUT_SUSPENDU = 'suspendu';

    public const STATUTS = [
        self::STATUT_ACTIF,
        self::STATUT_INACTIF,
        self::STATUT_SUSPENDU,
    ];

    protected $fillable = [
        'code', 'titre', 'filiere_id', 'formateur_id', 'etablissement_id',
        'date_debut', 'date_fin', 'nb_places', 'description', 'statut', 'expire_le',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin'   => 'date',
        'expire_le'  => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELATIONS ====================

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

    // [!]️ La relation presences() a été SUPPRIMÉE
    // (table 'presences' supprimée de la base de données)

    // ==================== SCOPES ====================

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;

        return $query->where(function ($q) use ($term) {
            $q->where('code', 'like', "%{$term}%")
              ->orWhere('titre', 'like', "%{$term}%")
              ->orWhereHas('formateur', function ($qq) use ($term) {
                  $qq->where('nom', 'like', "%{$term}%")
                     ->orWhere('prenom', 'like', "%{$term}%")
                     ->orWhere('matricule', 'like', "%{$term}%");
              });
        });
    }

    public function scopeActif($query)
    {
        return $query->where('statut', self::STATUT_ACTIF);
    }

    public function scopeInactif($query)
    {
        return $query->where('statut', self::STATUT_INACTIF);
    }

    public function scopeSuspendu($query)
    {
        return $query->where('statut', self::STATUT_SUSPENDU);
    }

    // ==================== HELPERS ====================

    public function estEnCours(): bool
    {
        return $this->statut === self::STATUT_ACTIF
            && $this->date_debut <= now()
            && $this->date_fin >= now();
    }

    public function estTerminee(): bool
    {
        return $this->statut === self::STATUT_INACTIF
            || ($this->date_fin && $this->date_fin < now());
    }

    public function estAVenir(): bool
    {
        return $this->statut === self::STATUT_ACTIF
            && $this->date_debut > now();
    }

    public function estSuspendue(): bool
    {
        return $this->statut === self::STATUT_SUSPENDU;
    }

    public function estExpiree(): bool
    {
        return $this->date_fin && $this->date_fin < now();
    }

    // ==================== GÉNÉRATION CODE AUTO ====================

    public static function generateNextCode(): string
    {
        $annee = (int) date('Y');
        $prefix = sprintf('SESS-%d-', $annee);

        $last = self::where('code', 'like', $prefix . '%')
            ->orderByRaw('CAST(SUBSTR(code, ' . (strlen($prefix) + 1) . ') AS INTEGER) DESC')
            ->value('code');

        $numero = $last ? (int) substr($last, strlen($prefix)) + 1 : 1;

        return sprintf('%s%04d', $prefix, $numero);
    }
}