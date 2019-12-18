<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo('App\Admin', 'gallery_created_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo('App\Admin', 'gallery_updated_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany('App\Image', 'gallery_id', 'gallery_id');
    }
}
