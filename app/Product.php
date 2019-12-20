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
                    Constant::TABLE_PRODUCT . '.product_thumbnail',
                    Constant::TABLE_PRODUCT . '.product_price',
                ]
            )
            ->where(
                Constant::TABLE_PRODUCT . '.product_status',
                '=',
                1
            )
            ->where(
                Constant::TABLE_PRODUCT . '.product_is_deleted',
                '=',
                0
            )
            ->orderBy(Constant::TABLE_PRODUCT . '.product_rate', 'desc')
            ->get()->take(10);
    }

    public static function getProductByIdClient($productId)
    {
        $productId = intval($productId);
        return DB::table(Constant::TABLE_PRODUCT)
            ->select(
                [
                    Constant::TABLE_PRODUCT . '.*',
                    Constant::TABLE_CATEGORY . '.category_id',
                    Constant::TABLE_CATEGORY . '.category_name',
                    Constant::TABLE_BRAND . '.brand_id',
                    Constant::TABLE_BRAND . '.brand_name'
                ]
            )
            ->join(
                Constant::TABLE_BRAND_CATEGORY,
                Constant::TABLE_PRODUCT . '.brand_category_id',
                '=',
                Constant::TABLE_BRAND_CATEGORY . '.brand_category_id'
            )
            ->join(
                Constant::TABLE_BRAND,
                Constant::TABLE_BRAND_CATEGORY . '.brand_id',
                '=',
                Constant::TABLE_BRAND . '.brand_id'
            )
            ->join(
                Constant::TABLE_CATEGORY,
                Constant::TABLE_BRAND_CATEGORY . '.category_id',
                '=',
                Constant::TABLE_CATEGORY . '.category_id'
            )
            ->where('product_id', '=', $productId)
            ->where(
                Constant::TABLE_PRODUCT . '.product_status',
                '=',
                1
            )
            ->where(
                Constant::TABLE_PRODUCT . '.product_is_deleted',
                '=',
                0
            )
            ->first();
    }


    public static function getProductByCategoryClient($categoryId)
    {
        $categoryId = intval($categoryId);
        return DB::table(Constant::TABLE_PRODUCT)
            ->select(
                [
                    Constant::TABLE_PRODUCT . '.*',
                    Constant::TABLE_CATEGORY . '.category_name',
                    Constant::TABLE_CATEGORY . '.category_id',
                    Constant::TABLE_PRODUCT . '.product_thumbnail'
                ]
            )
            ->join(
                Constant::TABLE_BRAND_CATEGORY,
                Constant::TABLE_PRODUCT . '.brand_category_id',
                '=',
                Constant::TABLE_BRAND_CATEGORY . '.brand_category_id'
            )
            ->join(
                Constant::TABLE_CATEGORY,
                Constant::TABLE_BRAND_CATEGORY . '.category_id',
                '=',
                Constant::TABLE_CATEGORY . '.category_id'
            )
            ->join(
                Constant::TABLE_BRAND,
                Constant::TABLE_BRAND_CATEGORY . '.brand_id',
                '=',
                Constant::TABLE_BRAND . '.brand_id'
            )
            ->where(
                Constant::TABLE_CATEGORY . '.category_id',
                '=',
                $categoryId
            )
            ->where(
                Constant::TABLE_PRODUCT . '.product_status',
                '=',
                1
            )
            ->where(
                Constant::TABLE_PRODUCT . '.product_is_deleted',
                '=',
                0
            )
            ->paginate(16);
    }

    public static function getProductByCategoryBrandClient($categoryId, $brandId)
    {
        $categoryId = intval($categoryId);
        $brandId = intval($brandId);
        return DB::table(Constant::TABLE_PRODUCT)
            ->select(
                [
                    Constant::TABLE_PRODUCT . '.*',
                    Constant::TABLE_CATEGORY . '.category_name',
                    Constant::TABLE_CATEGORY . '.category_id',
                    Constant::TABLE_PRODUCT . '.product_thumbnail'
                ]
            )
            ->join(
                Constant::TABLE_BRAND_CATEGORY,
                Constant::TABLE_PRODUCT . '.brand_category_id',
                '=',
                Constant::TABLE_BRAND_CATEGORY . '.brand_category_id'
            )
            ->join(
                Constant::TABLE_CATEGORY,
                Constant::TABLE_BRAND_CATEGORY . '.category_id',
                '=',
                Constant::TABLE_CATEGORY . '.category_id'
            )
            ->join(
                Constant::TABLE_BRAND,
                Constant::TABLE_BRAND_CATEGORY . '.brand_id',
                '=',
                Constant::TABLE_BRAND . '.brand_id'
            )
            ->where(
                Constant::TABLE_BRAND . '.brand_id',
                '=',
                $brandId
            )
            ->where(
                Constant::TABLE_CATEGORY . '.category_id',
                '=',
                $categoryId
            )
            ->where(
                Constant::TABLE_PRODUCT . '.product_status',
                '=',
                1
            )
            ->where(
                Constant::TABLE_PRODUCT . '.product_is_deleted',
                '=',
                0
            )
            ->paginate(16);
    }

    public static function getProductClient($categoryId, $brandId, $sortType, $itemPerPage)
    {
        $categoryId = intval($categoryId);
        $brandId = intval($brandId);
        $sortType = intval($sortType);
        $itemPerPage = intval($itemPerPage);

        $result = DB::table(Constant::TABLE_PRODUCT)
            ->select(
                [
                    Constant::TABLE_PRODUCT . '.*',
                    Constant::TABLE_CATEGORY . '.category_name',
                    Constant::TABLE_CATEGORY . '.category_id',
                    Constant::TABLE_PRODUCT . '.product_thumbnail'
                ]
            )->join(
                Constant::TABLE_BRAND_CATEGORY,
                Constant::TABLE_PRODUCT . '.brand_category_id',
                '=',
                Constant::TABLE_BRAND_CATEGORY . '.brand_category_id'
            )->join(
                Constant::TABLE_CATEGORY,
                Constant::TABLE_BRAND_CATEGORY . '.category_id',
                '=',
                Constant::TABLE_CATEGORY . '.category_id'
            )->join(
                Constant::TABLE_BRAND,
                Constant::TABLE_BRAND_CATEGORY . '.brand_id',
                '=',
                Constant::TABLE_BRAND . '.brand_id'
            )->where(
                Constant::TABLE_CATEGORY . '.category_id',
                '=',
                $categoryId
            )->where(
                Constant::TABLE_PRODUCT . '.product_status',
                '=',
                1
            )->where(
                Constant::TABLE_PRODUCT . '.product_is_deleted',
                '=',
                0
            );

        if ($brandId != 0) {
            $result = $result->where(
                Constant::TABLE_BRAND . '.brand_id',
                '=',
                $brandId
            );
        }

        switch ($sortType) {
            case 2:
            {
                $result->orderBy(Constant::TABLE_PRODUCT . '.product_rate', 'asc');
                break;
            }
            case 3:
            {
                $result->orderBy(Constant::TABLE_PRODUCT . '.product_price', 'desc');
                break;
            }
            case 4:
            {
                $result->orderBy(Constant::TABLE_PRODUCT . '.product_price', 'asc');
                break;
            }
            case 1:
            default:
            {
                $result->orderBy(Constant::TABLE_PRODUCT . '.product_rate', 'desc');
                break;
            }
        }


        if ($itemPerPage == 0) {
            $result = $result->paginate(12);
        } else {
            $result = $result->paginate($itemPerPage);
        }

        return $result;
    }
}
