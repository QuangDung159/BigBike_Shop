<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @property int $image_id
 * @property int $gallery_id
 * @property int $image_updated_by
 * @property int $image_created_by
 * @property string $image_path
 * @property int $image_created_at
 * @property int $image_updated_at
 * @property boolean $image_status
 * @property boolean $image_is_delete
 * @property Admin $admin
 * @property Admin $admin
 * @property Gallery $gallery
 */
class Image extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'image';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'image_id';

    /**
     * @var array
     */
    protected $fillable = ['gallery_id', 'image_updated_by', 'image_created_by', 'image_path', 'image_created_at', 'image_updated_at', 'image_status', 'image_is_delete'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin_created()
    {
        return $this->belongsTo('App\Admin', 'image_created_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin_updated()
    {
        return $this->belongsTo('App\Admin', 'image_updated_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gallery()
    {
        return $this->belongsTo('App\Gallery', 'gallery_id', 'gallery_id');
    }

    public static function getListImageByProductIdClient($productId)
    {
        $productId = intval($productId);
        return DB::table(Constant::TABLE_IMAGE)
            ->select(
                [
                    Constant::TABLE_PRODUCT . '.product_id',
                    Constant::TABLE_IMAGE . '.image_path'
                ]
            )
            ->join(
                Constant::TABLE_GALLERY,
                Constant::TABLE_IMAGE . '.gallery_id',
                '=',
                Constant::TABLE_GALLERY . '.gallery_id'
            )
            ->join(
                Constant::TABLE_PRODUCT,
                Constant::TABLE_GALLERY . '.product_id',
                '=',
                Constant::TABLE_PRODUCT . '.product_id'
            )
            ->where(
                Constant::TABLE_PRODUCT . '.product_id',
                '=',
                $productId
            )
            ->where(
                Constant::TABLE_IMAGE . '.image_status',
                '=',
                1
            )
            ->where(
                Constant::TABLE_IMAGE . '.image_is_deleted',
                '=',
                0
            )
            ->get();
    }

    public static function insert($data)
    {
        return DB::table(Constant::TABLE_IMAGE)
            ->insert($data);
    }

    /**
     * @param int $galleryId
     * @return Collection
     */
    public static function getImageByGalleryId($galleryId)
    {
        $galleryId = intval($galleryId);
        return DB::table(Constant::TABLE_IMAGE)
            ->where(
                Constant::TABLE_IMAGE . '.gallery_id',
                '=',
                $galleryId
            )
            ->where(
                Constant::TABLE_IMAGE . '.image_is_deleted',
                '=',
                0
            )
            ->get();
    }

    /**
     * @param int $imageId
     * @param array $data
     * @return int
     */
    public static function updateById($imageId, $data)
    {
        return DB::table(Constant::TABLE_IMAGE)
            ->where(
                Constant::TABLE_IMAGE . '.image_id',
                '=',
                $imageId
            )
            ->update($data);
    }

    /**
     * @param int $imageId
     * @return Model|Builder|object|null
     */
    public static function getById($imageId)
    {
        $imageId = intval($imageId);
        return DB::table(Constant::TABLE_IMAGE)
            ->where(
                Constant::TABLE_IMAGE . '.image_id',
                '=',
                $imageId
            )->first();
    }
}
