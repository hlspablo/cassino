<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GameLog
 *
 * @method static \Illuminate\Database\Eloquent\Builder|GameLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GameLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GameLog query()
 * @mixin \Eloquent
 */
class GameLog extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_logs';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'time',
        'game_id',
        'ip',
        'str',
        'shop_id',
    ];
}
