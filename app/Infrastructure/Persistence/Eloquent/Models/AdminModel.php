<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminModel extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'admins';

    protected $fillable = [
        'nom', 'prenom', 'email', 'password', 'role', 'avatar',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getNomCompletAttribute(): string
    {
        return trim(($this->prenom ?? '') . ' ' . ($this->nom ?? ''));
    }

    public function estSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function estGestionnaire(): bool
    {
        return $this->role === 'gestionnaire';
    }

    protected static function newFactory()
    {
        return \Database\Factories\AdminFactory::new();
    }
}