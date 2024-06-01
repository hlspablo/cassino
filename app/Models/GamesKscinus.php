<?php

namespace App\Models {

	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
 * @mixin \Eloquent
 */
class GamesKscinus extends Model
	{
		use HasFactory;

		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
		protected $table = 'games_kscinus';

		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array
		 */
		protected $fillable = [
			'title',
			'category_id',
			'type',
			'key',
			'money_ratio',
			'device',
			'views',
			'cover',
			'description',
			'status'
		];

		/**
		 * @return BelongsTo
		 */
		public function category(): BelongsTo
		{
			return $this->belongsTo(Category::class);
		}
	}
}
