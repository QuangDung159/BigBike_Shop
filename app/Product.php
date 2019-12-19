<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property int $product_id
 * @property int $brand_category_id
 * @property int $product_created_by
 * @property int $product_updated_by
 * @property string $product_name
 * @property string $product_desc
 * @property string $product_content
 * @property float $product_price
 * @property float $product_promotion_price
 * @property int $product_stock
 * @property float $product_rate
 * @property int $product_created_at
 * @property int $product_updated_at
 * @property boolean $product_status
 * @property boolean $product_is_deleted
 * @property Admin $admin
 * @property Admin $admin
 * @property BrandCategory $brandCategory
 * @property Gallery[] $galleries
 * @property OrderProduct[] $orderProducts
 * @property Review[] $reviews
 */
class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'product_id';

    /**
     * @var array
     */
    protected $fillable = ['brand_category_id', 'product_created_by', 'product_updated_by', 'product_name', 'product_desc', 'product_content', 'product_price', 'product_promotion_price', 'product_stock', 'product_rate', 'product_created_at', 'product_updated_at', 'product_status', 'product_is_deleted'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin_created()
    {
        return $this->belongsTo('App\Admin', 'product_created_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin_updated()
    {
        return $this->belongsTo('App\Admin', 'product_updated_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brandCategory()
    {
        return $this->belongsTo('App\BrandCategory', 'brand_category_id', 'brand_category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany('App\Gallery', 'product_id', 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct', 'product_id', 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany('App\Review', 'product_id', 'product_id');
    }

    public static function getFeatureProduct()
    {
        return DB::table(Constant::TABLE_PRODUCT)
            ->select([
                    Constant::TABLE_PRODUCT . '.product_id',
                    Constant::TABLE_PRODUCT . '.product_name',
                    Constant::TABLE_IMAGE . '.image_path',
                    Constant::TABLE_PRODUCT . '.product_price',
                ]
            )
            ->join(Constant::TABLE_GALLERY, Constant::TABLE_PRODUCT . '.product_id', '=', Constant::TABLE_GALLERY . '.product_id')
            ->join(Constant::TABLE_IMAGE, Constant::TABLE_GALLERY . '.gallery_id', '=', Constant::TABLE_IMAGE . '.gallery_id')
            ->orderBy(Constant::TABLE_PRODUCT . '.product_rate', 'desc')
            ->get();
    }
}
