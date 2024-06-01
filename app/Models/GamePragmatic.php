<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GamePragmatic
 *
 * @method static \Illuminate\Database\Eloquent\Builder|GamePragmatic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GamePragmatic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GamePragmatic query()
 * @mixin \Eloquent
 */
class GamePragmatic extends Model
{
    use HasFactory;

    public static array $values = [
        'denomination' => 1
    ];

    /**
     * @var string
     */
    protected $table = 'game_pragmatics';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'title',
        'jpg_id',
        'label',
        'device',
        'gamebank',
        'chanceFirepot1',
        'chanceFirepot2',
        'chanceFirepot3',
        'fireCount1',
        'fireCount2',
        'fireCount3',
        'lines_percent_config_spin',
        'lines_percent_config_spin_bonus',
        'lines_percent_config_bonus',
        'lines_percent_config_bonus_bonus',
        'rezerv',
        'cask',
        'advanced',
        'bet',
        'scaleMode',
        'slotViewState',
        'view',
        'denomination',
        'category_temp',
        'original_id',
        'bids',
        'stat_in',
        'current_rtp',
        'rtp_stat_in',
        'rtp_stat_out',
    ];
}
