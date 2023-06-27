<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Publisher extends Model
{
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'publisher_user');
    }
}
