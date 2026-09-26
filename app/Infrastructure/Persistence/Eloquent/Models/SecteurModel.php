<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecteurModel extends Model
{
    use HasFactory;

    protected $table = 'secteurs';

    protected $fillable = ['code', 'libelle'];

    public function filieres()
    {
        return $this->hasMany(FiliereModel::class, 'secteur_id');
    }

    protected static function newFactory()
    {
        return \Database\Factories\SecteurFactory::new();
    }
}