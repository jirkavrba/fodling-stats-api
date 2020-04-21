<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Institution extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'color'
    ];

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class, 'institution_id', 'id');
    }
}
