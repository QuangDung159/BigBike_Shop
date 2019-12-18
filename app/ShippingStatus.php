<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $shipping_status_id
 * @property string $shipping_status_name
 * @property Order[] $orders
 */
class ShippingStatus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shipping_status';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'shipping_status_id';

    /**
     * @var array
     */
    protected $fillable = ['shipping_status_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order', 'shipping_status_id', 'shipping_status_id');
    }
}
