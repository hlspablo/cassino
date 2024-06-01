<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string|null $software_name
 * @property string|null $software_description
 * @property string|null $software_logo_white
 * @property string|null $software_logo_black
 * @property string $currency_code
 * @property string $decimal_format
 * @property string $currency_position
 * @property int|null $revshare_percentage
 * @property int|null $ngr_percent
 * @property string $prefix
 * @property string $storage
 * @property int|null $initial_bonus
 * @property string|null $merchant_url
 * @property string|null $merchant_id
 * @property string|null $merchant_key
 * @property string|null $min_deposit
 * @property string|null $max_deposit
 * @property string|null $min_withdrawal
 * @property string|null $max_withdrawal
 * @property string|null $suitpay_uri
 * @property string|null $suitpay_cliente_id
 * @property string|null $suitpay_cliente_secret
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $software_smtp_type
 * @property string|null $software_smtp_mail_host
 * @property string|null $software_smtp_mail_port
 * @property string|null $software_smtp_mail_username
 * @property string|null $software_smtp_mail_password
 * @property string|null $software_smtp_mail_encryption
 * @property string|null $software_smtp_mail_from_address
 * @property string|null $software_smtp_mail_from_name
 * @property string|null $kscinus_pub_key
 * @property string|null $kscinus_pvt_key
 * @property string|null $instagram
 * @property string|null $whatsapp
 * @property string|null $promo_banner
 * @property string|null $promo_text
 * @property string|null $promo_link
 * @property string $min_rollover
 * @property string|null $game_level
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCurrencyPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDecimalFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereGameLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereInitialBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereKscinusPubKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereKscinusPvtKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMaxDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMaxWithdrawal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMerchantKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMerchantUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMinDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMinRollover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMinWithdrawal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereNgrPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting wherePromoBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting wherePromoLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting wherePromoText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereRevsharePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSoftwareDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSoftwareLogoBlack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSoftwareLogoWhite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSoftwareName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSoftwareSmtpMailEncryption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSoftwareSmtpMailFromAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSoftwareSmtpMailFromName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSoftwareSmtpMailHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSoftwareSmtpMailPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSoftwareSmtpMailPort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSoftwareSmtpMailUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSoftwareSmtpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereStorage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSuitpayClienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSuitpayClienteSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSuitpayUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereWhatsapp($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'software_name',
        'software_description',
        'software_logo_white',
        'software_logo_black',
        'currency_code',
        'decimal_format',
        'currency_position',
        'prefix',
        'storage',
        'merchant_url',
        'merchant_id',
        'merchant_key',
        'min_deposit',
        'max_deposit',
        'min_withdrawal',
        'max_withdrawal',

        // Percent
        'ngr_percent',
        'revshare_percentage',
        'initial_bonus',

        // Suitpay
        'suitpay_uri',
        'suitpay_cliente_id',
        'suitpay_cliente_secret',

        // smtp
        'software_smtp_type',
        'software_smtp_mail_host',
        'software_smtp_mail_port',
        'software_smtp_mail_username',
        'software_smtp_mail_password',
        'software_smtp_mail_encryption',
        'software_smtp_mail_from_address',
        'software_smtp_mail_from_name',

        // kscinus
        'kscinus_pvt_key',
        'kscinus_pub_key',

        // new
        'instagram',
        'whatsapp',
        'promo_banner',
        'promo_text',
        'promo_link',
        'min_rollover',
        'game_level'
    ];

    protected $hidden = array('created_at', 'updated_at');
}
