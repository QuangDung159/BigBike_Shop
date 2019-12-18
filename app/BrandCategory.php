<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    public function admin()
    {
        return $this->belongsTo('App\Admin', 'brand_category_created_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
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
}
