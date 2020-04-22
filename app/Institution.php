<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static Collection apiRepresentation()
 */
class Institution extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'color'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class, 'institution_id', 'id');
    }

    public static function scopeApiRepresentation(Builder $query): Collection
    {
        $collection = $query->with('teams')->get();

        // Remap each team's folding id to actual id so it can be used in the client
        foreach ($collection as $institution)
        {
            foreach ($institution->teams as $index => $team)
            {
                $institution->teams[$index]->id = $team->folding_id;
            }
        }

        return $collection;
    }

}
