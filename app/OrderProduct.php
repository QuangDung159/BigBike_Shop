<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
     * @return BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id', 'order_id');
    }

    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'product_id');
    }

    /**
     * @param array $arrData
     * @return bool
     */
    public static function insert($arrData)
    {
        return DB::table(Constant::TABLE_ORDER_PRODUCT)
            ->insert($arrData);
    }

    /**
     * @param int $productId
     * @return Collection
     */
    public static function getListOrderContainProduct($productId)
    {
        $productId = intval($productId);
        return DB::table(Constant::TABLE_ORDER_PRODUCT)
            ->select(
                [
                    Constant::TABLE_ORDER . '.shipping_status_id',
                    Constant::TABLE_ORDER . '.order_id',
                ]
            )
            ->join(
                Constant::TABLE_ORDER,
                Constant::TABLE_ORDER_PRODUCT . '.order_id',
                '=',
                Constant::TABLE_ORDER . '.order_id'
            )
            ->where(
                Constant::TABLE_ORDER_PRODUCT . '.product_id',
                '=',
                $productId
            )
            ->get();
    }
}
