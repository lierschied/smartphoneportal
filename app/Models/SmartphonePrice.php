<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\SmartphonePrice
 *
 * @property int $id
 * @property int|null $smartphone_id
 * @property int|null $currency_id
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Smartphone[] $smartphones
 * @property-read int|null $smartphones_count
 * @method static \Database\Factories\SmartphonePriceFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartphonePrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SmartphonePrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SmartphonePrice query()
 * @method static \Illuminate\Database\Eloquent\Builder|SmartphonePrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartphonePrice whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartphonePrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartphonePrice wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartphonePrice whereSmartphoneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmartphonePrice whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Currency|null $currency
 * @property-read \App\Models\Smartphone|null $smartphone
 */
class SmartphonePrice extends Model
{
    use HasFactory;

    /** Relationships */

    public function smartphone(): BelongsTo
    {
        return $this->belongsTo(Smartphone::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
