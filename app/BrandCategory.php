<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

/**
 * @property int $brand_category_id
 * @property int $brand_id
 * @property int $category_id
 * @property int $brand_category_created_by
 * @property int $brand_category_updated_by
 * @property int $brand_category_created_at
 * @property int $brand_category_updated_at
 * @property boolean $brand_category_status
 * @property boolean $brand_category_is_deleted
 * @property Admin $admin
 * @property Admin $admin
 * @property Brand $brand
 * @property Category $category
 * @property Product[] $products
 */
class BrandCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'brand_category';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'brand_category_id';

    /**
     * @var array
     */
    protected $fillable = ['brand_id', 'category_id', 'brand_category_created_by', 'brand_category_updated_by', 'brand_category_created_at', 'brand_category_updated_at', 'brand_category_status', 'brand_category_is_deleted'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin_created()
    {
        return $this->belongsTo('App\Admin', 'brand_category_created_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin_updated()
    {
        return $this->belongsTo('App\Admin', 'brand_category_updated_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo('App\Brand', 'brand_id', 'brand_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Product', 'brand_category_id', 'brand_category_id');
    }

    public static function getBrandCategory()
    {
        return DB::table(Constant::TABLE_BRAND_CATEGORY)
            ->select(
                [
                    Constant::TABLE_CATEGORY . '.category_name',
                    Constant::TABLE_CATEGORY . '.category_id',
                    Constant::TABLE_BRAND . '.brand_id',
                    Constant::TABLE_BRAND . '.brand_name',
                    Constant::TABLE_BRAND_CATEGORY . '.*',
                ]
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
            ->where(
                Constant::TABLE_BRAND_CATEGORY . '.brand_category_is_deleted',
                '=',
                0
            )
            ->orderBy(
                Constant::TABLE_BRAND_CATEGORY . '.brand_category_created_at',
                'desc'
            )
            ->orderBy(
                Constant::TABLE_BRAND_CATEGORY . '.brand_id',
                'asc'
            )->paginate(10);
    }

    public static function updateByBrandCategoryId($brandCategoryId, $arrData)
    {
        $brandCategoryId = intval($brandCategoryId);
        DB::table(Constant::TABLE_BRAND_CATEGORY)
            ->where(
                Constant::TABLE_BRAND_CATEGORY . '.brand_category_id',
                '=',
                $brandCategoryId
            )
            ->update($arrData);
    }

    public static function insert($data)
    {
        return DB::table(Constant::TABLE_BRAND_CATEGORY)
            ->insert($data);
    }

    public static function getByBrandIdCategoryId($brandId, $categoryId)
    {
        $brandId = intval($brandId);
        $categoryId = intval($categoryId);

        return DB::table(Constant::TABLE_BRAND_CATEGORY)
            ->where(
                Constant::TABLE_BRAND_CATEGORY . '.brand_id',
                '=',
                $brandId
            )
            ->where(
                Constant::TABLE_BRAND_CATEGORY . '.category_id',
                '=',
                $categoryId
            )
            ->where(
                Constant::TABLE_BRAND_CATEGORY . '.brand_category_is_deleted',
                '=',
                0
            )->first();
    }

    public static function getBrandNameCategoryNameById($brandCategoryId)
    {
        $brandCategoryId = intval($brandCategoryId);
        return DB::table(Constant::TABLE_BRAND_CATEGORY)
            ->select(
                [
                    Constant::TABLE_BRAND_CATEGORY . '.*',
                    Constant::TABLE_BRAND . '.brand_name',
                    Constant::TABLE_CATEGORY . '.category_name',
                    Constant::TABLE_BRAND_CATEGORY . '.brand_id',
                    Constant::TABLE_BRAND_CATEGORY . '.category_id',
                ]
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
            ->where(
                Constant::TABLE_BRAND_CATEGORY . '.brand_category_id',
                '=',
                $brandCategoryId
            )
            ->where(
                Constant::TABLE_BRAND_CATEGORY . '.brand_category_is_deleted',
                '=',
                0
            )
            ->first();
    }
}
