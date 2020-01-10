<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

/**
 * @property int $gallery_id
 * @property int $product_id
 * @property int $gallery_created_by
 * @property int $gallery_updated_by
 * @property int $gallery_created_at
 * @property int $gallery_updated_at
 * @property boolean $gallery_status
 * @property boolean $gallery_is_deleted
 * @property Admin $admin
 * @property Product $product
 * @property Image[] $images
 */
class Gallery extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gallery';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'gallery_id';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'gallery_created_by', 'gallery_updated_by', 'gallery_created_at', 'gallery_updated_at', 'gallery_status', 'gallery_is_deleted'];

    /**
     * @return BelongsTo
     */
    public function admin_created()
    {
        return $this->belongsTo('App\Admin', 'gallery_created_by', 'admin_id');
    }

    /**
     * @return BelongsTo
     */
    public function admin_updated()
    {
        return $this->belongsTo('App\Admin', 'gallery_updated_by', 'admin_id');
    }

    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'product_id');
    }

    /**
     * @return HasMany
     */
    public function images()
    {
        return $this->hasMany('App\Image', 'gallery_id', 'gallery_id');
    }

    public static function getAll()
    {
        return DB::table(Constant::TABLE_GALLERY)
            ->select(
                [
                    Constant::TABLE_GALLERY . '.*',
                    Constant::TABLE_PRODUCT . '.product_name',
                ]
            )
            ->join(
                Constant::TABLE_PRODUCT,
                Constant::TABLE_GALLERY . '.product_id',
                '=',
                Constant::TABLE_PRODUCT . '.product_id'
            )
            ->where(
                Constant::TABLE_GALLERY . '.gallery_is_deleted',
                '=',
                0
            )
            ->orderBy(
                Constant::TABLE_GALLERY . '.gallery_created_at',
                'desc'
            )
            ->paginate(10);
    }

    public static function insertGetId($data)
    {
        return DB::table(Constant::TABLE_GALLERY)
            ->insertGetId($data);
    }

    /**
     * @param int $galleryId
     * @return Model|Builder|object|null
     */
    public static function getGalleryProductById($galleryId)
    {
        $galleryId = intval($galleryId);
        return DB::table(Constant::TABLE_GALLERY)
            ->select(
                [
                    Constant::TABLE_GALLERY . '.*',
                    Constant::TABLE_PRODUCT . '.product_name',
                    Constant::TABLE_PRODUCT . '.product_id',
                    Constant::TABLE_PRODUCT . '.product_name',
                ]
            )
            ->join(
                Constant::TABLE_PRODUCT,
                Constant::TABLE_GALLERY . '.product_id',
                '=',
                Constant::TABLE_PRODUCT . '.product_id'
            )
            ->where(
                Constant::TABLE_GALLERY . '.gallery_is_deleted',
                '=',
                0
            )
            ->where(
                Constant::TABLE_GALLERY . '.gallery_id',
                '=',
                $galleryId
            )
            ->first();
    }

    /**
     * @param int $galleryId
     * @return Model|Builder|object|null
     */
    public static function getById($galleryId)
    {
        $galleryId = intval($galleryId);
        return DB::table(Constant::TABLE_GALLERY)
            ->where(
                Constant::TABLE_GALLERY . '.gallery_is_deleted',
                '=',
                0
            )
            ->where(
                Constant::TABLE_GALLERY . '.gallery_id',
                '=',
                $galleryId
            )
            ->first();
    }

    /**
     * @param int $galleryId
     * @param array $data
     * @return int
     */
    public static function updateById($galleryId, $data)
    {
        $galleryId = intval($galleryId);
        return DB::table(Constant::TABLE_GALLERY)
            ->where(
                Constant::TABLE_GALLERY . '.gallery_id',
                '=',
                $galleryId
            )
            ->update($data);
    }

    /**
     * @param int $productId
     * @return Model|Builder|object|null
     */
    public static function getGalleryByProductId($productId)
    {
        $productId = intval($productId);
        return DB::table(Constant::TABLE_GALLERY)
            ->join(
                Constant::TABLE_PRODUCT,
                Constant::TABLE_GALLERY . '.product_id',
                '=',
                Constant::TABLE_PRODUCT . '.product_id'
            )
            ->where(
                Constant::TABLE_GALLERY . '.gallery_is_deleted',
                '=',
                0
            )
            ->where(
                Constant::TABLE_PRODUCT . '.product_is_deleted',
                '=',
                0
            )
            ->where(
                Constant::TABLE_PRODUCT . '.product_id',
                '=',
                $productId
            )
            ->first();
    }

    /**
     * @param int $productId
     * @param array $data
     * @return int
     */
    public static function updateByProductId($productId, $data)
    {
        $productId = intval($productId);
        return DB::table(Constant::TABLE_GALLERY)
            ->where(
                Constant::TABLE_GALLERY . '.product_id',
                '=',
                $productId
            )
            ->update($data);
    }

    /**
     * @param int $productId
     * @return int
     */
    public static function removeByProductId($productId)
    {
        $productId = intval($productId);
        return DB::table(Constant::TABLE_GALLERY)
            ->where(
                Constant::TABLE_GALLERY . '.product_id',
                '=',
                $productId
            )
            ->delete();
    }
}
