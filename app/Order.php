<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

/**
 * @property int $order_id
 * @property int $shipping_status_id
 * @property int $user_id
 * @property int $order_updated_by
 * @property int $order_created_at
 * @property int $order_updated_at
 * @property boolean $order_status
 * @property boolean $order_is_deleted
 * @property Admin $admin
 * @property ShippingStatus $shippingStatus
 * @property User $user
 * @property OrderProduct[] $orderProducts
 */
class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'order_id';

    /**
     * @var array
     */
    protected $fillable = ['shipping_status_id', 'user_id', 'order_updated_by', 'order_created_at', 'order_updated_at', 'order_status', 'order_is_deleted'];

    /**
     * @return BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo('App\Admin', 'order_updated_by', 'admin_id');
    }

    /**
     * @return BelongsTo
     */
    public function shippingStatus()
    {
        return $this->belongsTo('App\ShippingStatus', 'shipping_status_id', 'shipping_status_id');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    /**
     * @return HasMany
     */
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct', 'order_id', 'order_id');
    }

    /**
     * @param array $arrData
     * @return int
     */
    public static function insertOrderGetId($arrData)
    {
        return DB::table(Constant::TABLE_ORDER)
            ->insertGetId($arrData);
    }
}
