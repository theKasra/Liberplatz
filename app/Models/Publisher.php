<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Publisher extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'province',
        'city',
        'street',
        'zipcode',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'publisher_user');
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
