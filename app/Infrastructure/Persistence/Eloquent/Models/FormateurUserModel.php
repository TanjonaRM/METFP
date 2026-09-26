<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormateurUserModel extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'formateurs_users';

    protected $fillable = [
        'nom', 'prenom', 'email', 'password', 'matricule',
        'telephone', 'etablissement_id', 'avatar', 'statut',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function etablissement()
    {
        return $this->belongsTo(EtablissementModel::class, 'etablissement_id');
    }

    public function formateur()
    {
        return $this->hasOne(FormateurModel::class, 'matricule', 'matricule');
    }

    public function getNomCompletAttribute(): string
    {
        return trim(($this->prenom ?? '') . ' ' . ($this->nom ?? ''));
    }

    public function estActif(): bool
    {
        return $this->statut === 'actif';
    }

    protected static function newFactory()
    {
        return \Database\Factories\FormateurUserFactory::new();
    }
}