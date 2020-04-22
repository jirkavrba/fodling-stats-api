<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Team
 * @package App
 * @property-read Collection $results
 */
class Team extends Model
{
    protected $fillable = [
        'folding_id',
        'name',
        'institution_id',
    ];

    protected $hidden = [
        'folding_id', // Aliased as id
        'institution_id',
        'created_at',
        'updated_at',
    ];

    public function getRouteKeyName()
    {
        return 'folding_id';
    }


    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class, 'institution_id', 'id');
    }

    public function results(): HasMany
    {
        return $this->hasMany(TeamResult::class, 'team_id', 'id');
    }
}
