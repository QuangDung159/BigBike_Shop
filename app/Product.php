<?php

namespace App;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

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
     * @return BelongsTo
     */
    public function admin_created()
    {
        return $this->belongsTo('App\Admin', 'product_created_by', 'admin_id');
    }

    /**
     * @return BelongsTo
     */
    public function admin_updated()
    {
        return $this->belongsTo('App\Admin', 'product_updated_by', 'admin_id');
    }

    /**
     * @return BelongsTo
     */
    public function brandCategory()
    {
        return $this->belongsTo('App\BrandCategory', 'brand_category_id', 'brand_category_id');
    }

    /**
     * @return HasMany
     */
    public function galleries()
    {
        return $this->hasMany('App\Gallery', 'product_id', 'product_id');
    }

    /**
     * @return HasMany
     */
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct', 'product_id', 'product_id');
    }

    /**
     * @return HasMany
     */
    public function reviews()
    {
        return $this->hasMany('App\Review', 'product_id', 'product_id');
    }

    /**
     * @return Collection
     */
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

    /**
     * @param int $productId
     * @return Model|Builder|object|null
     */
    public static function getByIdClient($productId)
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

    /**
     * @param int $categoryId
     * @return LengthAwarePaginator
     */
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

    /**
     * @param int $categoryId
     * @param int $brandId
     * @return LengthAwarePaginator
     */
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

    /**
     * @param int $categoryId
     * @param int $brandId
     * @param int $sortType
     * @param int $itemPerPage
     * @return LengthAwarePaginator|Builder
     */
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

    /**
     * @param int $status
     * @return Collection
     */
    public static function getByStatus($status)
    {
        $status = intval($status);
        return DB::table(Constant::TABLE_PRODUCT)
            ->where(
                Constant::TABLE_PRODUCT . '.product_status',
                '=',
                $status
            )
            ->where(
                Constant::TABLE_PRODUCT . '.product_is_deleted',
                '=',
                0
            )
            ->get();
    }

    /**
     * @return Builder
     */
    public static function getAll()
    {
        return DB::table(Constant::TABLE_PRODUCT)
            ->where(
                Constant::TABLE_PRODUCT . '.product_is_deleted',
                '=',
                0
            );
    }

    /**
     * @return Collection
     */
    public static function getListProductWithoutGallery()
    {
        return DB::table(Constant::TABLE_PRODUCT)
            ->select(
                [
                    Constant::TABLE_PRODUCT . '.product_name',
                    Constant::TABLE_PRODUCT . '.product_id',
                ]
            )
            ->leftJoin(
                Constant::TABLE_GALLERY,
                Constant::TABLE_PRODUCT . '.product_id',
                '=',
                Constant::TABLE_GALLERY . '.product_id'
            )
            ->where(
                Constant::TABLE_GALLERY . '.gallery_id',
                '=',
                null
            )
            ->where(
                Constant::TABLE_PRODUCT . '.product_is_deleted',
                '=',
                0
            )
            ->get();
    }

    /**
     * @param int $productId
     * @param array $arrData
     */
    public static function updateByProductId($productId, $arrData)
    {
        $productId = intval($productId);
        DB::table(Constant::TABLE_PRODUCT)
            ->where(
                Constant::TABLE_PRODUCT . '.product_id',
                '=',
                $productId
            )
            ->update($arrData);
    }

    /**
     * @param array $data
     */
    public static function insert($data)
    {
        DB::table(Constant::TABLE_PRODUCT)
            ->insert($data);
    }

    /**
     * @param string $productName
     * @return Model|Builder|object
     */
    public static function getProductByName($productName)
    {
        $productName = trim($productName);
        return DB::table(Constant::TABLE_PRODUCT)
            ->where(
                Constant::TABLE_PRODUCT . '.product_is_deleted',
                '=',
                0
            )
            ->where(
                Constant::TABLE_PRODUCT . '.product_name',
                '=',
                $productName
            )->first();
    }

    /**
     * @param int $productId
     * @return Model|Builder|object|null
     */
    public static function getById($productId)
    {
        $productId = intval($productId);
        return DB::table(Constant::TABLE_PRODUCT)
            ->where(
                Constant::TABLE_PRODUCT . '.product_id',
                '=',
                $productId
            )
            ->where(
                Constant::TABLE_PRODUCT . '.product_is_deleted',
                '=',
                0
            )
            ->first();
    }

    /**
     * @param int $orderId
     * @return Collection
     */
    public static function getListProductByOrderId($orderId)
    {
        $orderId = intval($orderId);
        return DB::table(Constant::TABLE_PRODUCT)
            ->select(
                [
                    Constant::TABLE_PRODUCT . '.product_name',
                    Constant::TABLE_PRODUCT . '.product_thumbnail',
                    Constant::TABLE_PRODUCT . '.product_promotion_price',
                    Constant::TABLE_ORDER_PRODUCT . '.order_product_qty',
                ]
            )
            ->join(
                Constant::TABLE_ORDER_PRODUCT,
                Constant::TABLE_PRODUCT . '.product_id',
                '=',
                Constant::TABLE_ORDER_PRODUCT . '.product_id'
            )
            ->where(
                Constant::TABLE_ORDER_PRODUCT . '.order_id',
                '=',
                $orderId
            )
            ->get();
    }

    /**
     * @param string $brandName
     * @return Model|Builder|object
     */
    public static function get5NewestProductByBrandName($brandName)
    {
        $brandId = trim($brandName);
        return DB::table(Constant::TABLE_PRODUCT)
            ->select(
                [
                    Constant::TABLE_PRODUCT . '.product_name',
                    Constant::TABLE_PRODUCT . '.product_thumbnail',
                    Constant::TABLE_PRODUCT . '.product_desc',
                    Constant::TABLE_PRODUCT . '.product_id',
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
            ->where(
                Constant::TABLE_BRAND . '.brand_name',
                '=',
                $brandName
            )
            ->orderBy(
                Constant::TABLE_PRODUCT . '.product_created_at',
                'desc'
            )
            ->limit(5)
            ->get();
    }
}
