<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    public function admin()
    {
        return $this->belongsTo('App\Admin', 'image_created_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
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
}
