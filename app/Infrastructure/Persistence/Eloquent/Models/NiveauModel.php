<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauModel extends Model
{
    use HasFactory;

    protected $table = 'niveaux';

    protected $fillable = ['code', 'libelle', 'description'];

    public function filieres()
    {
        return $this->hasMany(FiliereModel::class, 'niveau_id');
    }

    protected static function newFactory()
    {
        return \Database\Factories\NiveauFactory::new();
    }
}