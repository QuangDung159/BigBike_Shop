<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $admin_id
 * @property int $action_module_id
 * @property int $admin_created_by
 * @property int $admin_updated_by
 * @property string $admin_name
 * @property string $admin_email
 * @property string $admin_password
 * @property boolean $admin_is_root
 * @property int $admin_created_at
 * @property int $admin_updated_at
 * @property boolean $admin_status
 * @property boolean $admin_is_deleted
 * @property ActionModule $actionModule
 * @property Admin $admin
 * @property Admin $admin
 * @property Brand[] $brands
 * @property Brand[] $brands
 * @property BrandCategory[] $brandCategories
 * @property BrandCategory[] $brandCategories
 * @property Category[] $categories
 * @property Category[] $categories
 * @property Gallery[] $galleries
 * @property Gallery[] $galleries
 * @property Image[] $images
 * @property Image[] $images
 * @property Order[] $orders
 * @property Product[] $products
 * @property Product[] $products
 * @property Slide[] $slides
 * @property Slide[] $slides
 */
class Admin extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'admin_id';

    /**
     * @var array
     */
    protected $fillable = ['action_module_id', 'admin_created_by', 'admin_updated_by', 'admin_name', 'admin_email', 'admin_password', 'admin_is_root', 'admin_created_at', 'admin_updated_at', 'admin_status', 'admin_is_deleted'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function actionModule()
    {
        return $this->belongsTo('App\ActionModule', 'action_module_id', 'action_module_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo('App\Admin', 'admin_created_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo('App\Admin', 'admin_updated_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function brands()
    {
        return $this->hasMany('App\Brand', 'brand_created_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function brands()
    {
        return $this->hasMany('App\Brand', 'brand_updated_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function brandCategories()
    {
        return $this->hasMany('App\BrandCategory', 'brand_category_created_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function brandCategories()
    {
        return $this->hasMany('App\BrandCategory', 'brand_category_updated_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany('App\Category', 'category_created_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany('App\Category', 'category_updated_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany('App\Gallery', 'gallery_created_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany('App\Gallery', 'gallery_updated_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany('App\Image', 'image_created_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany('App\Image', 'image_updated_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order', 'order_updated_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Product', 'product_created_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Product', 'product_updated_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slides()
    {
        return $this->hasMany('App\Slide', 'slide_created_by', 'admin_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slides()
    {
        return $this->hasMany('App\Slide', 'slide_updated_by', 'admin_id');
    }
}
