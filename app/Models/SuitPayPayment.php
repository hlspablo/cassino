<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\SuitPayPayment
 *
 * @property int $id
 * @property string|null $payment_id
 * @property int|null $user_id
 * @property int|null $withdrawal_id
 * @property string|null $pix_key
 * @property string|null $pix_type
 * @property string $amount
 * @property string|null $observation
 * @property int|null $status
 * @property mixed $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $date_human_readable
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|SuitPayPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SuitPayPayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SuitPayPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|SuitPayPayment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuitPayPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuitPayPayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuitPayPayment whereObservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuitPayPayment wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuitPayPayment wherePixKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuitPayPayment wherePixType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuitPayPayment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuitPayPayment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuitPayPayment whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuitPayPayment whereWithdrawalId($value)
 * @mixin \Eloquent
 */
class SuitPayPayment extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'suit_pay_payments';
    protected $appends = ['dateHumanReadable', 'createdAt'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_id',
        'user_id',
        'withdrawal_id',
        'pix_key',
        'pix_type',
        'amount',
        'observation',
        'status'
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
