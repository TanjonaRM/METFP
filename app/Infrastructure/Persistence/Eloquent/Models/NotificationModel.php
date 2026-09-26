<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationModel extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'titre',
        'message',
        'type',
        'icone',
        'lu',
        'lien',
        'data',
    ];

    protected $casts = [
        'lu' => 'boolean',
        'data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(AdminModel::class, 'user_id');
    }

    public function scopeNonLues($query)
    {
        return $query->where('lu', false);
    }

    public function scopeRecentes($query, int $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }
}