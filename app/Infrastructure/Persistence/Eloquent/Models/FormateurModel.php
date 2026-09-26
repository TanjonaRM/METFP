<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormateurModel extends Model
{
    use SoftDeletes;

    protected $table = 'formateurs';

    // ==================== STATUTS ====================
    public const STATUT_ACTIF    = 'actif';
    public const STATUT_INACTIF  = 'inactif';
    public const STATUT_SUSPENDU = 'suspendu';

    public const STATUTS = [
        self::STATUT_ACTIF,
        self::STATUT_INACTIF,
        self::STATUT_SUSPENDU,
    ];

    protected $fillable = [
        'matricule', 'nom', 'prenom', 'sexe', 'date_naissance',
        'lieu_naissance', 'cin', 'email', 'telephone', 'adresse',
        'grade', 'date_recrutement', 'photo',
        'etablissement_id', 'filiere_id', 'statut',
    ];

    protected $casts = [
        'date_naissance'   => 'date',
        'date_recrutement' => 'date',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
        'deleted_at'       => 'datetime',
    ];

    // ==================== RELATIONS ====================
    // [!]️ 1 formateur = 1 établissement / 1 filière
    // 1 formateur = N affectations / N sessions (mais 1 seule active à la fois)

    public function etablissement(): BelongsTo
    {
        return $this->belongsTo(EtablissementModel::class, 'etablissement_id');
    }

    public function filiere(): BelongsTo
    {
        return $this->belongsTo(FiliereModel::class, 'filiere_id');
    }

    public function affectations(): HasMany
    {
        return $this->hasMany(AffectationModel::class, 'formateur_id');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(SessionModel::class, 'formateur_id');
    }

    /**
     * Retourne l'affectation active actuelle (une seule)
     */
    public function affectationActive()
    {
        return $this->hasOne(AffectationModel::class, 'formateur_id')
            ->where('statut', self::STATUT_ACTIF)
            ->latest();
    }

    /**
     * Retourne la session active actuelle (une seule)
     */
    public function sessionActive()
    {
        return $this->hasOne(SessionModel::class, 'formateur_id')
            ->where('statut', self::STATUT_ACTIF)
            ->latest();
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

    // ==================== PROPAGATION STATUT ====================

    /**
     * Propage le statut du formateur à TOUTES les entités liées.
     * Appelé automatiquement quand formateurs.statut change.
     */
    public function propagerStatut(): void
    {
        $statut = $this->statut;

        // 1. Propager aux affectations
        $this->affectations()->update(['statut' => $statut]);

        // 2. Propager aux sessions
        $this->sessions()->update(['statut' => $statut]);

        // 3. Propager à l'établissement (si plus aucun formateur actif -> inactif)
        $this->mettreAJourEtablissement();

        // 4. Propager à la filière (si plus aucun formateur actif -> inactif)
        $this->mettreAJourFiliere();
    }

    /**
     * Met à jour le statut de l'établissement.
     * Actif si AU MOINS UN formateur actif, sinon inactif.
     */
    public function mettreAJourEtablissement(): void
    {
        if (!$this->etablissement_id) return;

        $etablissement = EtablissementModel::find($this->etablissement_id);
        if (!$etablissement) return;

        $aFormateurActif = $etablissement->formateurs()
            ->where('statut', self::STATUT_ACTIF)
            ->exists();

        $nouveauStatut = $aFormateurActif
            ? EtablissementModel::STATUT_ACTIF
            : EtablissementModel::STATUT_INACTIF;

        if ($etablissement->statut !== $nouveauStatut) {
            $etablissement->update(['statut' => $nouveauStatut]);
        }
    }

    /**
     * Met à jour le statut de la filière.
     * Actif si AU MOINS UN formateur actif, sinon inactif.
     */
    public function mettreAJourFiliere(): void
    {
        if (!$this->filiere_id) return;

        $filiere = FiliereModel::find($this->filiere_id);
        if (!$filiere) return;

        $aFormateurActif = $filiere->formateurs()
            ->where('statut', self::STATUT_ACTIF)
            ->exists();

        $nouveauStatut = $aFormateurActif
            ? FiliereModel::STATUT_ACTIF
            : FiliereModel::STATUT_INACTIF;

        if ($filiere->statut !== $nouveauStatut) {
            $filiere->update(['statut' => $nouveauStatut]);
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