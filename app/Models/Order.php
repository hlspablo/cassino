<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Order
 *
 * @property string $status
 * @property string $won_amount
 * @property int $id
 * @property int $user_id
 * @property string|null $session_id
 * @property string|null $transaction_id
 * @property string $game_uuid
 * @property string $type
 * @property string $type_money
 * @property string $bet
 * @property int $refunded
 * @property string|null $round_id
 * @property mixed $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $bonus_bet
 * @property-read mixed $date_human_readable
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBonusBet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereGameUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRefunded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRoundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTypeMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereWonAmount($value)
 * @property string $used_type_money
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUsedTypeMoney($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';
    protected $appends = ['dateHumanReadable', 'createdAt'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'session_id',
        'transaction_id',
        'game',
        'game_uuid',
        'type',
        'used_type_money',
        'bet',
        'bonus_bet',
        'won_amount',
        'refunded',
        'round_id',
        'status',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
