<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WalletChange
 *
 * @property int $id
 * @property string|null $reason
 * @property string|null $change
 * @property string $value_bonus
 * @property string $value_total
 * @property string $value_roi
 * @property string $value_entry
 * @property string|null $game
 * @property string|null $user
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WalletChange newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletChange newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletChange query()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletChange whereChange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletChange whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletChange whereGame($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletChange whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletChange whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletChange whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletChange whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletChange whereValueBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletChange whereValueEntry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletChange whereValueRoi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletChange whereValueTotal($value)
 * @mixin \Eloquent
 */
class WalletChange extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'wallet_changes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reason',
        'change',
        'value_bonus',
        'value_total',
        'value_roi',
        'value_entry',
        'game',
        'user',
    ];
}
