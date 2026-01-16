<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JamSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue_id',
        'title',
        'genre',
        'starts_at',
        'description',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
    ];

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }
}
