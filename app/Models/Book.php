<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_book');
    }

    public function users_status(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'book_user_status');
    }

    public function users_rating(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'book_user_rating');
    }

    public function users_quote(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'book_user_quote');
    }
}
