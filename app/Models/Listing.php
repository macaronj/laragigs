<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
    //
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['company', 'email', 'website', 'tags', 'title', 'location', 'description', 'logo', 'user_id'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%'.request('tag').'%');
        }

        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%'.request('search').'%')
                ->orWhere('description', 'like', '%'.request('search').'%')
                ->orWhere('location', 'like', '%'.request('search').'%')
                ->orWhere('tags', 'like', '%'.request('search').'%')
                ->orWhere('company', 'like', '%'.request('search').'%');

        }

    }

    /**
     * Get the user that owns the listing.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
