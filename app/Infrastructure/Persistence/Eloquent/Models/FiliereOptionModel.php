<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiliereOptionModel extends Model
{
    use HasFactory;

    protected $table = 'filiere_options';

    protected $fillable = ['filiere_id', 'libelle'];

    public function filiere()
    {
        return $this->belongsTo(FiliereModel::class, 'filiere_id');
    }
}