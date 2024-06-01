<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GamesHash
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $hash
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|GamesHash newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GamesHash newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GamesHash query()
 * @method static \Illuminate\Database\Eloquent\Builder|GamesHash whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesHash whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesHash whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesHash whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesHash whereUserId($value)
 * @mixin \Eloquent
 */
class GamesHash extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'games_hashes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'hash',
    ];
}
