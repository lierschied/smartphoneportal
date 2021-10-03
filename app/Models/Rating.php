<?php

namespace App\Models;

use Database\Factories\RatingFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Rating
 *
 * @property int $id
 * @property string $stars
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static RatingFactory factory(...$parameters)
 * @method static Builder|Rating newModelQuery()
 * @method static Builder|Rating newQuery()
 * @method static Builder|Rating query()
 * @method static Builder|Rating whereCreatedAt($value)
 * @method static Builder|Rating whereId($value)
 * @method static Builder|Rating whereStars($value)
 * @method static Builder|Rating whereTotal($value)
 * @method static Builder|Rating whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int|null $user_id
 * @property int|null $smartphone_id
 * @property-read User|null $user
 * @method static Builder|Rating whereSmartphoneId($value)
 * @method static Builder|Rating whereUserId($value)
 */
class Rating extends Model
{
    use HasFactory;

    protected $hidden = [
        'user_id',
    ];

    protected $fillable = [
        'smartphone_id',
        'user_id',
        'stars',
    ];

    /** Relationships */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
