<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;

class Discussion extends Model
{
    protected $fillable = ['title', 'slug', 'topic_id', 'user_id'];

    public function scopeOrderByPinned($query)
    {
        return $query->orderBy('pinned_at', 'desc');
    }

    public function isPinned(): bool
    {
        return !is_null($this->pinned_at);
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function post(): HasOne
    {
        return $this->hasOne(Post::class)->where('parent_id', null);
    }

    public function latestPost()
    {
        return $this->hasOne(Post::class)->latestOfMany();
    }

    public function participants()
    {
        return $this->hasManyThrough(User::class, Post::class, 'discussion_id', 'id', 'id', 'user_id')->distinct();
    }
}
