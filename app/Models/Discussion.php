<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;

class Discussion extends Model
{
    protected $fillable = ['title', 'slug', 'topic_id', 'user_id'];


    protected static function booted(): void
    {
        static::created(function ($discussion) {
            $discussion->update(['slug' => $discussion->title]);
        });
    }

    public function setSlugAttribute($value): void
    {
        $this->attributes['slug'] = $this->id.'-'.Str::slug($value);
    }

    public function scopeOrderByPinned($query)
    {
        return $query->orderBy('pinned_at', 'desc');
    }

    public function scopeOrderByLastPost($query)
    {
        return $query->orderBy(
            Post::select('created_at')
                ->whereColumn('posts.discussion_id', 'discussions.id')
                ->latest()
                ->take(1),
            'desc'
        );
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

    public function replies(): HasMany
    {
        return $this->hasMany(Post::class)->where('parent_id', '!=', null);
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
