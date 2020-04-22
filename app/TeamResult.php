<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamResult extends Model
{
    protected $fillable = [
        'team_id',
        'datetime',
        'score'
    ];

    protected $hidden = [
        'id',
        'team_id',
        'created_at',
        'updated_at',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }
}
