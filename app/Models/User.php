<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function publishers(): BelongsToMany
    {
        return $this->belongsToMany(Publisher::class, 'publisher_user');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_user', 'follower_id', 'following_id');
    }

    public function books_status(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_user_status');
    }

    public function books_rating(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_user_rating');
    }

    public function books_quote(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_user_quote');
    }
}
