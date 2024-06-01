<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GameBank
 *
 * @method static \Illuminate\Database\Eloquent\Builder|GameBank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GameBank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GameBank query()
 * @mixin \Eloquent
 */
class GameBank extends Model
{
    use HasFactory;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_banks';

    /**
     * @var string[]
     */
    protected $fillable = [
        'slots',
        'little',
        'table_bank',
        'bonus',
        'temp_rtp',
        'shop_id',
    ];
}
