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

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class, 'institution_id', 'id');
    }
}
