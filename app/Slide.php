<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $slide_id
 * @property int $slide_created_by
 * @property int $slide_updated_by
 * @property string $slide_path
 * @property int $slide_created_at
 * @property int $slide_updated_at
 * @property boolean $slide_status
 * @property boolean $slide_is_deleted
 * @property Admin $admin
 * @property Admin $admin
 */
class Slide extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'slide';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'slide_id';

    /**
     * @var array
     */
    protected $fillable = ['slide_created_by', 'slide_updated_by', 'slide_path', 'slide_created_at', 'slide_updated_at', 'slide_status', 'slide_is_deleted'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo('App\Admin', 'slide_created_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo('App\Admin', 'slide_updated_by', 'admin_id');
    }
}
