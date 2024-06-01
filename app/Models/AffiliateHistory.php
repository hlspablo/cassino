<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\AffiliateHistory
 *
 * @property int $id
 * @property int $user_id
 * @property int $inviter
 * @property string $commission
 * @property string|null $commission_type
 * @property int|null $deposited
 * @property string|null $deposited_amount
 * @property int|null $losses
 * @property string|null $losses_amount
 * @property string|null $commission_paid
 * @property int $status
 * @property mixed $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $date_human_readable
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateHistory whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateHistory whereCommissionPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateHistory whereCommissionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateHistory whereDeposited($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateHistory whereDepositedAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateHistory whereInviter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateHistory whereLosses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateHistory whereLossesAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateHistory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateHistory whereUserId($value)
 * @mixin \Eloquent
 */
class AffiliateHistory extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'affiliate_histories';
    protected $appends = ['dateHumanReadable', 'createdAt'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'inviter',
        'commission',
        'commission_type',
        'deposited',
        'deposited_amount',
        'losses',
        'losses_amount',
        'commission_paid',
        'status',
    ];

    /**
     * Get the user's first name.
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->getStatus($value),
        );
    }

    /**
     * @param $status
     * @return string|void
     */
    private function getStatus($status)
    {
        switch ($status) {
            case '1':
                return 'pago';
            case '0':
                return 'pendente';
        }
    }

    /**
     * @return mixed
     */
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at']);
    }

    /**
     * @return mixed
     */
    public function getDateHumanReadableAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
