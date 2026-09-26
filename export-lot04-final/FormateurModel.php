<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormateurModel extends Model
{
    use SoftDeletes;

    protected $table = 'formateurs';

    // ==================== STATUTS ====================
    public const STATUT_ACTIF     = 'actif';
    public const STATUT_INACTIF   = 'inactif';
    public const STATUT_SUSPENDU  = 'suspendu';

    public const STATUTS = [
        self::STATUT_ACTIF,
        self::STATUT_INACTIF,
        self::STATUT_SUSPENDU,
    ];

    protected $fillable = [
        'matricule', 'nom', 'prenom', 'sexe', 'date_naissance',
        'lieu_naissance', 'cin', 'email', 'telephone', 'adresse',
        'grade', 'date_recrutement', 'photo', 'etablissement_id', 'statut',
    ];

    protected $casts = [
        'date_naissance'   => 'date',
        'date_recrutement' => 'date',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
        'deleted_at'       => 'datetime',
    ];

    // ==================== RELATIONS ====================

    public function etablissement(): BelongsTo
    {
        return $this->belongsTo(EtablissementModel::class, 'etablissement_id');
    }

    public function filieres(): BelongsToMany
    {
        return $this->belongsToMany(
            FiliereModel::class,
            'formateur_filieres',
            'formateur_id',
            'filiere_id'
        )->withTimestamps();
    }

    public function affectations(): HasMany
    {
        return $this->hasMany(AffectationModel::class, 'formateur_id');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(SessionModel::class, 'formateur_id');
    }

    // ==================== SCOPES ====================

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;
        return $query->where(function ($q) use ($term) {
            $q->where('nom', 'like', "%{$term}%")
              ->orWhere('prenom', 'like', "%{$term}%")
              ->orWhere('matricule', 'like', "%{$term}%")
              ->orWhere('email', 'like', "%{$term}%")
              ->orWhere('telephone', 'like', "%{$term}%");
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

    // ==================== MATRICULE AUTO ====================

    public static function generateNextMatricule(): string
    {
        $prefix = 'FORM-';

        $last = self::withTrashed()
            ->where('matricule', 'like', $prefix . '%')
            ->orderByRaw('CAST(SUBSTR(matricule, ' . (strlen($prefix) + 1) . ') AS INTEGER) DESC')
            ->value('matricule');

        $numero = $last ? (int) substr($last, strlen($prefix)) + 1 : 1;

        return sprintf('%s%03d', $prefix, $numero);
    }

    // ==================== SYNCHRONISATION STATUT ====================

    /**
     * Recalcule le statut du formateur selon ses sessions.
     *
     * Priorité (du plus fort au plus faible) :
     * 1. Si AU MOINS UNE session est suspendue → SUSPENDU
     * 2. Sinon, si AU MOINS UNE session est active ET non expirée → ACTIF
     * 3. Sinon → INACTIF
     */
    public function recalculerStatut(): void
    {
        // 1. Vérifier s'il y a une session suspendue en cours
        $aSuspendu = $this->sessions()
            ->where('statut', SessionModel::STATUT_SUSPENDU)
            ->exists();

        if ($aSuspendu) {
            $this->update(['statut' => self::STATUT_SUSPENDU]);
            return;
        }

        // 2. Vérifier s'il y a une session active non expirée
        $aActif = $this->sessions()
            ->where('statut', SessionModel::STATUT_ACTIVE)
            ->where(function ($q) {
                $q->whereNull('date_fin')
                  ->orWhere('date_fin', '>=', now()->toDateString());
            })
            ->exists();

        // 3. Appliquer
        $nouveauStatut = $aActif
            ? self::STATUT_ACTIF
            : self::STATUT_INACTIF;

        if ($this->statut !== $nouveauStatut) {
            $this->update(['statut' => $nouveauStatut]);
        }
    }

    // ==================== HELPERS ====================

    public function estActif(): bool
    {
        return $this->statut === self::STATUT_ACTIF;
    }

    public function estInactif(): bool
    {
        return $this->statut === self::STATUT_INACTIF;
    }

    public function estSuspendu(): bool
    {
        return $this->statut === self::STATUT_SUSPENDU;
    }
}