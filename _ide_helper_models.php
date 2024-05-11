<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
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
 */
	class AffiliateHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BetCategory
 *
 * @property int $id
 * @property int $bet_section_id
 * @property string $name
 * @property string $description
 * @property string|null $image
 * @property int $active
 * @property string $slug
 * @property mixed $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BetSection|null $betSection
 * @property-read mixed $date_human_readable
 * @method static \Illuminate\Database\Eloquent\Builder|BetCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BetCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BetCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|BetCategory whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetCategory whereBetSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetCategory whereUpdatedAt($value)
 */
	class BetCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BetEvent
 *
 * @property int $id
 * @property int $bet_category_id
 * @property string|null $cover
 * @property string $name
 * @property string $description
 * @property string $event_a
 * @property string $event_a_logo
 * @property string $event_b
 * @property string $event_b_logo
 * @property string $event_day
 * @property string|null $event_result_a
 * @property string|null $event_result_b
 * @property int $finished
 * @property mixed $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BetCategory|null $betCategory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BetUser> $bets
 * @property-read mixed $bets_count
 * @property-read mixed $bets_amounts
 * @property-read mixed $bets_amounts_with_percent
 * @property-read mixed $date_human_readable
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent whereBetCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent whereEventA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent whereEventALogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent whereEventB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent whereEventBLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent whereEventDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent whereEventResultA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent whereEventResultB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent whereFinished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetEvent whereUpdatedAt($value)
 */
	class BetEvent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BetSection
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BetCategory> $betCategories
 * @property-read int|null $bet_categories_count
 * @method static \Illuminate\Database\Eloquent\Builder|BetSection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BetSection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BetSection query()
 * @method static \Illuminate\Database\Eloquent\Builder|BetSection whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetSection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetSection whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetSection whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetSection whereUpdatedAt($value)
 */
	class BetSection extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BetUser
 *
 * @property int $id
 * @property int $bet_event_id
 * @property int $user_id
 * @property string $amount
 * @property string $event_result_a
 * @property string $event_result_b
 * @property string|null $reward_received
 * @property int $winner
 * @property mixed $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BetEvent|null $event
 * @property-read mixed $date_human_readable
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|BetUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BetUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BetUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|BetUser whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetUser whereBetEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetUser whereEventResultA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetUser whereEventResultB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetUser whereRewardReceived($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetUser whereWinner($value)
 */
	class BetUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string|null $image
 * @property string|null $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Deposit
 *
 * @property int $id
 * @property string|null $payment_id
 * @property int $user_id
 * @property string $amount
 * @property string $type
 * @property string|null $proof
 * @property int $status
 * @property mixed $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $date_human_readable
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereProof($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereUserId($value)
 */
	class Deposit extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Game
 *
 * @property int $id
 * @property int|null $category_id
 * @property string $name
 * @property string $uuid
 * @property string $image
 * @property string $type
 * @property string $provider
 * @property string|null $provider_service
 * @property string $technology
 * @property int $has_lobby
 * @property int $is_mobile
 * @property int $has_freespins
 * @property int $has_tables
 * @property string|null $slug
 * @property int $active
 * @property int|null $views
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\GamesHash|null $game_hash
 * @method static \Illuminate\Database\Eloquent\Builder|Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereHasFreespins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereHasLobby($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereHasTables($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereIsMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereProviderService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereTechnology($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereViews($value)
 */
	class Game extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GameBank
 *
 * @method static \Illuminate\Database\Eloquent\Builder|GameBank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GameBank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GameBank query()
 */
	class GameBank extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GameExclusive
 *
 * @property int $id
 * @property int $category_id
 * @property string $uuid
 * @property string $name
 * @property string $description
 * @property string $cover
 * @property string $icon
 * @property int $winLength
 * @property int $loseLength
 * @property int $influencer_winLength
 * @property int $influencer_loseLength
 * @property string $iconsJson
 * @property int|null $active
 * @property int|null $views
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive query()
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereIconsJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereInfluencerLoseLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereInfluencerWinLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereLoseLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameExclusive whereWinLength($value)
 */
	class GameExclusive extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GameLog
 *
 * @method static \Illuminate\Database\Eloquent\Builder|GameLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GameLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GameLog query()
 */
	class GameLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GamePragmatic
 *
 * @method static \Illuminate\Database\Eloquent\Builder|GamePragmatic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GamePragmatic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GamePragmatic query()
 */
	class GamePragmatic extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GamesHash
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $hash
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|GamesHash newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GamesHash newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GamesHash query()
 * @method static \Illuminate\Database\Eloquent\Builder|GamesHash whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesHash whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesHash whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesHash whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesHash whereUserId($value)
 */
	class GamesHash extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GamesKscinus
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $cover
 * @property string|null $description
 * @property string|null $rtp
 * @property int|null $category_id
 * @property string|null $developer
 * @property int|null $type
 * @property string|null $key
 * @property string|null $money_ratio
 * @property int|null $device
 * @property int|null $views
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus query()
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus whereDeveloper($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus whereDevice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus whereMoneyRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus whereRtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GamesKscinus whereViews($value)
 */
	class GamesKscinus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\JPG
 *
 * @method static \Illuminate\Database\Eloquent\Builder|JPG newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JPG newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JPG query()
 */
	class JPG extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $session_id
 * @property string|null $transaction_id
 * @property string $game
 * @property string $game_uuid
 * @property string $type
 * @property string $type_money
 * @property string $amount
 * @property string $providers
 * @property int $refunded
 * @property int $status
 * @property string|null $round_id
 * @property mixed $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $date_human_readable
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereGame($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereGameUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProviders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRefunded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRoundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTypeMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Session
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Session newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Session newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Session query()
 */
	class Session extends \Eloquent {}
}

namespace App\Models{
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
 * @property int|null $soccer_percentage
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
 * @property int|null $maintenance_mode
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
 * @property string|null $hoopay_uri
 * @property string|null $hoopay_cliente_id
 * @property string|null $hoopay_cliente_secret
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCurrencyPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDecimalFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereHoopayClienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereHoopayClienteSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereHoopayUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereInitialBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereKscinusPubKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereKscinusPvtKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMaintenanceMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMaxDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMaxWithdrawal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMerchantKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMerchantUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMinDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereMinWithdrawal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereNgrPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereRevsharePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSoccerPercentage($value)
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
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Shop
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop query()
 */
	class Shop extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Status
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Status newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Status newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Status query()
 */
	class Status extends \Eloquent {}
}

namespace App\Models{
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
 */
	class SuitPayPayment extends \Eloquent {}
}

namespace App\Models{
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
 */
	class SystemWallet extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property string $payment_id
 * @property int $user_id
 * @property string|null $payment_method
 * @property string $price
 * @property string $currency
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUserId($value)
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property int|null $role_id
 * @property string $name
 * @property int $is_admin
 * @property string|null $last_name
 * @property string|null $cpf
 * @property string|null $phone
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property int|null $token_time
 * @property string|null $token
 * @property int|null $logged_in
 * @property int|null $banned
 * @property int|null $inviter
 * @property string|null $affiliate_revenue_share
 * @property string|null $affiliate_cpa
 * @property string|null $affiliate_baseline
 * @property int|null $is_demo_agent
 * @property string|null $oauth_id
 * @property string|null $oauth_type
 * @property string $status
 * @property mixed $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $kscinus
 * @property-read mixed $date_human_readable
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\Wallet|null $wallet
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAffiliateBaseline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAffiliateCpa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAffiliateRevenueShare($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBanned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCpf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereInviter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsDemoAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKscinus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLoggedIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOauthId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOauthType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTokenTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Filament\Models\Contracts\FilamentUser {}
}

namespace App\Models{
/**
 * App\Models\Wallet
 *
 * @property int $id
 * @property int $user_id
 * @property string $balance
 * @property string $balance_bonus
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
 */
	class Wallet extends \Eloquent {}
}

namespace App\Models{
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
 */
	class WalletChange extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Withdrawal
 *
 * @property int $id
 * @property int $user_id
 * @property string $amount
 * @property string $type
 * @property string|null $proof
 * @property int $status
 * @property string|null $chave_pix
 * @property string $tipo_chave
 * @property mixed $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $date_human_readable
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereChavePix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereProof($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereTipoChave($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereUserId($value)
 */
	class Withdrawal extends \Eloquent {}
}

