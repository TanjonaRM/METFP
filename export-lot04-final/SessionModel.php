<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionModel extends Model
{
    protected $table = 'formations_sessions';

    protected $fillable = [
        'code',
        'titre',
        'filiere_id',
        'formateur_id',
        'etablissement_id',
        'date_debut',
        'date_fin',
        'nb_places',
        'description',
        'statut',
        'expire_le',
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

    // ==================== SCOPES ====================

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) {
            return $query;
        }

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
        return $query->where('statut', 'active');
    }

    public function scopeExpire($query)
    {
        return $query->where('statut', 'terminee');
    }

    // ==================== HELPERS ====================

    public function estEnCours(): bool
    {
        return $this->statut === 'active'
            && $this->date_debut <= now()
            && $this->date_fin >= now();
    }

    public function estTerminee(): bool
    {
        return $this->statut === 'terminee'
            || ($this->date_fin && $this->date_fin < now());
    }

    public function estAVenir(): bool
    {
        return $this->statut === 'active' && $this->date_debut > now();
    }

    public function estExpiree(): bool
    {
        return $this->date_fin && $this->date_fin < now();
    }

    // ==================== GÉNÉRATION CODE AUTO ====================

    /**
     * Génère un code session au format SESS-{YYYY}-{XXXX}
     */
    public static function generateNextCode(): string
    {
        $annee = (int) date('Y');
        $prefix = sprintf('SESS-%d-', $annee);

        $last = self::where('code', 'like', $prefix . '%')
            ->orderByRaw('CAST(SUBSTR(code, ' . (strlen($prefix) + 1) . ') AS INTEGER) DESC')
            ->value('code');

        if ($last) {
            $numero = (int) substr($last, strlen($prefix)) + 1;
        } else {
            $numero = 1;
        }

        return sprintf('%s%04d', $prefix, $numero);
    }
}