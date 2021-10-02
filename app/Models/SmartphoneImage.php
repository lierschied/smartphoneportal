<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\SmartphoneImage
 *
 * @property int $id
 * @property int|null $smartphone_id
 * @property string $img
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Smartphone|null $smartphone
 * @method static \Illuminate\Database\Eloquent\Builder|SmartphoneImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SmartphoneImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SmartphoneImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|SmartphoneImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartphoneImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartphoneImage whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartphoneImage whereSmartphoneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartphoneImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SmartphoneImage extends Model
{
    use HasFactory;

    /** Relationships */

    public function smartphone(): BelongsTo
    {
        return $this->belongsTo(Smartphone::class);
    }
}
