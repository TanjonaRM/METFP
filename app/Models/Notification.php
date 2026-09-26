<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'user_id', 'titre', 'message', 'type', 'icone', 'lu', 'lien', 'data',
    ];

    protected $casts = [
        'lu'   => 'boolean',
        'data' => 'array',
    ];
}