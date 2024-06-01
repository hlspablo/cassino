<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * App\Models\Wallet
 *
 * @property string $balance
 * @property string $balance_bonus
 * @property string $won_amount
 * @property int $id
 * @property int $user_id
 * @property string $anti_bot
 * @property string $total_bet
 * @property string|null $total_won
 * @property string|null $total_lose
 * @property string|null $last_won
 * @property string|null $last_lose
 * @property int|null $hide_balance
 * @property string|null $refer_rewards
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereAntiBot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereBalanceBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereHideBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereLastLose($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereLastWon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereReferRewards($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereTotalBet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereTotalLose($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereTotalWon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUserId($value)
 * @mixin \Eloquent
 */
class Wallet extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'wallets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'balance',
        'balance_bonus',
        'refer_rewards',
        'anti_bot',
        'total_bet',
        'total_won',
        'total_lose',
        'last_won',
        'last_lose',
        'hide_balance'
    ];

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
