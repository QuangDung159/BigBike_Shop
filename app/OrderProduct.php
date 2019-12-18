<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_product_id
 * @property int $product_id
 * @property int $order_id
 * @property int $order_product_qty
 * @property Order $order
 * @property Product $product
 */
class OrderProduct extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_product';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'order_product_id';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'order_id', 'order_product_qty'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'product_id');
    }
}
