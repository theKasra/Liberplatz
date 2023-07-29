<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    protected $fillable = [
        'title',
        'isbn',
        'description',
        'pages',
        'publisher_id',
        'year_of_publication',
    ];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_book')->withTimestamps();
    }

    public function users_status(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'book_user_status')
                    ->withPivot('status', 'description')
                    ->withTimestamps();
    }

    public function users_rating(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'book_user_rating')
                    ->withPivot('rating', 'comment', 'is_favorite')
                    ->withTimestamps();
    }

    public function users_quote(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'book_user_quote');
    }

    public function publishers(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }
}
