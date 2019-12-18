<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $category_id
 * @property int $category_created_by
 * @property int $category_updated_by
 * @property string $category_name
 * @property string $category_desc
 * @property int $category_created_at
 * @property int $category_updated_at
 * @property boolean $category_status
 * @property boolean $category_is_deleted
 * @property Admin $admin
 * @property Admin $admin
 * @property BrandCategory[] $brandCategories
 */
class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'category_id';

    /**
     * @var array
     */
    protected $fillable = ['category_created_by', 'category_updated_by', 'category_name', 'category_desc', 'category_created_at', 'category_updated_at', 'category_status', 'category_is_deleted'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo('App\Admin', 'category_created_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo('App\Admin', 'category_updated_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function brandCategories()
    {
        return $this->hasMany('App\BrandCategory', 'category_id', 'category_id');
    }
}
