<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SystemWallet
 *
 * @property int $id
 * @property string $label
 * @property string $balance
 * @property string $balance_min
 * @property string $pay_upto_percentage
 * @property string $mode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $can_pay
 * @method static \Illuminate\Database\Eloquent\Builder|SystemWallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemWallet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemWallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemWallet whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemWallet whereBalanceMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemWallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemWallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemWallet whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemWallet whereMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemWallet wherePayUptoPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemWallet whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SystemWallet extends Model
{
    use HasFactory;

    protected $table = 'system_wallets';
    protected $appends = ['canPay'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label',
        'balance',
        'balance_min',
        'pay_upto_percentage',
        'mode',
    ];


    /**
     * @return mixed
     */
    public function getCanPayAttribute()
    {
        if($this->balance >= $this->balance_min) {
            return true;
        }

        return false;
    }
}
