<?php

namespace App\Models;

use Auth;
use Database\Factories\CommentFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property int $user_id
 * @property int $commentable_id
 * @property string $commentable_type
 * @property string $comment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static CommentFactory factory(...$parameters)
 * @method static Builder|Comment newModelQuery()
 * @method static Builder|Comment newQuery()
 * @method static Builder|Comment query()
 * @method static Builder|Comment whereComment($value)
 * @method static Builder|Comment whereCommentableId($value)
 * @method static Builder|Comment whereCommentableType($value)
 * @method static Builder|Comment whereCreatedAt($value)
 * @method static Builder|Comment whereId($value)
 * @method static Builder|Comment whereUpdatedAt($value)
 * @method static Builder|Comment whereUserId($value)
 * @mixin Eloquent
 * @property-read User|null $user
 * @property int|null $smartphone_id
 * @property-read Collection|Like[] $likes
 * @property-read int|null $likes_count
 * @method static Builder|Comment whereSmartphoneId($value)
 * @property-read Model|Eloquent $commentable
 * @property-read Collection|Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read int $dislike_count
 * @property-read mixed $has_liked
 * @property-read int $like_count
 * @property-read mixed $likes_data
 */
class Comment extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:d.m Y',
    ];

    protected $fillable = [
        'comment',
        'user_id'
    ];

    /** Relationships */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(__CLASS__, 'commentable');
    }

    public function getHasLikedAttribute()
    {
        $likes = $this->likes->where('user_id', Auth::id())->first();

        if (empty($likes)) {
            return null;
        }

        return $likes->count() > 0 ? $likes->type : null;
    }

    public function getLikeCountAttribute(): int
    {
        return $this->likes->where('type', 'Like')->count();
    }

    public function getDislikeCountAttribute(): int
    {
        return $this->likes->where('type', 'Dislike')->count();

    }

    #[Pure] #[ArrayShape(['likes' => "int", 'dislikes' => "int", 'avg' => "float|int"])]
    public function getLikesDataAttribute(): array
    {
        $totalCount = $this->likes->count();
        $avg = $totalCount > 0 ? $this->like_count / $this->likes->count() : 0;
        return [
            'likes' => $this->like_count,
            'dislikes' => $this->dislike_count,
            'avg' => $avg
        ];
    }

}
