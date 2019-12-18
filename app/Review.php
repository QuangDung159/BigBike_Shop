<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $review_id
 * @property int $user_id
 * @property int $product_id
 * @property string $review_content
 * @property int $review_created_at
 * @property Product $product
 * @property User $user
 */
class Review extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'review';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'review_id';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'product_id', 'review_content', 'review_created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }
}
