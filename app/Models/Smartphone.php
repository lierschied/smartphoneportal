<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Smartphone
 *
 * @property int $id
 * @property string $model
 * @property float $price
 * @property string $brand
 * @property string $dimensions
 * @property float $weight
 * @property string $color
 * @property string $os
 * @property string $cpu
 * @property string $ram
 * @property int $storage
 * @property string $description
 * @property string $category
 * @property int $rating_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Database\Factories\SmartphoneFactory factory(...$parameters)
 * @method static Builder|Smartphone newModelQuery()
 * @method static Builder|Smartphone newQuery()
 * @method static Builder|Smartphone query()
 * @method static Builder|Smartphone whereBrand($value)
 * @method static Builder|Smartphone whereCategory($value)
 * @method static Builder|Smartphone whereColor($value)
 * @method static Builder|Smartphone whereCpu($value)
 * @method static Builder|Smartphone whereCreatedAt($value)
 * @method static Builder|Smartphone whereDescription($value)
 * @method static Builder|Smartphone whereDimensions($value)
 * @method static Builder|Smartphone whereId($value)
 * @method static Builder|Smartphone whereModel($value)
 * @method static Builder|Smartphone whereOs($value)
 * @method static Builder|Smartphone wherePrice($value)
 * @method static Builder|Smartphone whereRam($value)
 * @method static Builder|Smartphone whereRatingId($value)
 * @method static Builder|Smartphone whereStorage($value)
 * @method static Builder|Smartphone whereUpdatedAt($value)
 * @method static Builder|Smartphone whereWeight($value)
 * @mixin \Eloquent
 * @property int|null $brand_id
 * @property string|null $network_technology
 * @property string|null $launch_status
 * @property string|null $body_dimensions
 * @property string|null $body_weight
 * @property string|null $display_type
 * @property string|null $display_size
 * @property string|null $display_resolution
 * @property string|null $display
 * @property string|null $sound_35_mm_jack
 * @property string|null $comms_wlan
 * @property string|null $comms_bluetooth
 * @property string|null $comms_gps
 * @property string|null $comms_usb
 * @property string|null $features_sensors
 * @property string|null $features
 * @property string|null $misc_colors
 * @property string|null $platform_os
 * @property string|null $platform_chipset
 * @property string|null $platform_cpu
 * @property string|null $platform_gpu
 * @property string|null $memory_internal
 * @property string|null $main_camera_single
 * @property string|null $main_camera_video
 * @property string|null $body_build
 * @property string|null $comms_nfc
 * @property string|null $battery_charging
 * @property string|null $battery
 * @property string|null $battery_talk_time
 * @property string|null $battery_stand_by
 * @property int $featured
 * @property-read Collection|SmartphonePrice[] $smartphonePrices
 * @property-read int|null $smartphone_prices_count
 * @method static Builder|Smartphone whereBattery($value)
 * @method static Builder|Smartphone whereBatteryCharging($value)
 * @method static Builder|Smartphone whereBatteryStandBy($value)
 * @method static Builder|Smartphone whereBatteryTalkTime($value)
 * @method static Builder|Smartphone whereBodyBuild($value)
 * @method static Builder|Smartphone whereBodyDimensions($value)
 * @method static Builder|Smartphone whereBodyWeight($value)
 * @method static Builder|Smartphone whereBrandId($value)
 * @method static Builder|Smartphone whereCommsBluetooth($value)
 * @method static Builder|Smartphone whereCommsGps($value)
 * @method static Builder|Smartphone whereCommsNfc($value)
 * @method static Builder|Smartphone whereCommsUsb($value)
 * @method static Builder|Smartphone whereCommsWlan($value)
 * @method static Builder|Smartphone whereDisplay($value)
 * @method static Builder|Smartphone whereDisplayResolution($value)
 * @method static Builder|Smartphone whereDisplaySize($value)
 * @method static Builder|Smartphone whereDisplayType($value)
 * @method static Builder|Smartphone whereFeatured($value)
 * @method static Builder|Smartphone whereFeatures($value)
 * @method static Builder|Smartphone whereFeaturesSensors($value)
 * @method static Builder|Smartphone whereLaunchStatus($value)
 * @method static Builder|Smartphone whereMainCameraSingle($value)
 * @method static Builder|Smartphone whereMainCameraVideo($value)
 * @method static Builder|Smartphone whereMemoryInternal($value)
 * @method static Builder|Smartphone whereMiscColors($value)
 * @method static Builder|Smartphone whereNetworkTechnology($value)
 * @method static Builder|Smartphone wherePlatformChipset($value)
 * @method static Builder|Smartphone wherePlatformCpu($value)
 * @method static Builder|Smartphone wherePlatformGpu($value)
 * @method static Builder|Smartphone wherePlatformOs($value)
 * @method static Builder|Smartphone whereSound35MmJack($value)
 * @property-read Collection|Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read Collection|Rating[] $ratings
 * @property-read int|null $ratings_count
 * @property-read Collection|SmartphoneImage[] $smartphoneImages
 * @property-read int|null $smartphone_images_count
 */
class Smartphone extends Model
{
    use HasFactory;

    /* Relationships */

    public function smartphonePrices(): HasMany
    {
        return $this->hasMany(SmartphonePrice::class);
    }

    public function smartphoneImages(): HasMany
    {
        return $this->hasMany(SmartphoneImage::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }


    /* Accessor */
    public function getRatingsAttribute()
    {
        return $this->ratings()->avg('stars');
    }
}
