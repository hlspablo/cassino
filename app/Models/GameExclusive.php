<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\GameExclusive
 *
 * @property int $id
 * @property int $category_id
 * @property string $uuid
 * @property string $name
 * @property string $description
 * @property string $cover
 * @property string $icon
 * @property int $winLength
 * @property int $loseLength
 * @property int $influencer_winLength
 * @property int $influencer_loseLength
 * @property string $iconsJson
 * @property int|null $active
 * @property int|null $views
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive query()
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereIconsJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereInfluencerLoseLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereInfluencerWinLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereLoseLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereWinLength($value)
 * @mixin \Eloquent
 */
class GameExclusive extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_exclusives';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'uuid',
        'name',
        'description',
        'cover',
        'icon',
        'winLength',
        'loseLength',
        'influencer_winLength',
        'influencer_loseLength',
        'active',
        'views'
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

}
