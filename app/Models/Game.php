<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Game
 *
 * @property int $has_lobby
 * @property int $id
 * @property int|null $category_id
 * @property string $name
 * @property string $uuid
 * @property string|null $image
 * @property string $type
 * @property string $provider
 * @property string $technology
 * @property int $is_mobile
 * @property int $has_freespins
 * @property int $has_tables
 * @property string|null $slug
 * @property int $active
 * @property int|null $views
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $freespin_valid_until_full_day
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\GamesHash|null $game_hash
 * @method static \Illuminate\Database\Eloquent\Builder|Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereFreespinValidUntilFullDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereHasFreespins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereHasLobby($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereHasTables($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereIsMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereTechnology($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereViews($value)
 * @mixin \Eloquent
 */
class Game extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'games';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'uuid',
        'image',
        'type',
        'provider',
        'technology',
        'has_lobby',
        'is_mobile',
        'has_freespins',
        'has_tables',
        'freespin_valid_until_full_day',
        'slug',
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

    /**
     * @return HasOne
     */
    public function game_hash() : HasOne
    {
        return $this->hasOne(GamesHash::class);
    }
}
