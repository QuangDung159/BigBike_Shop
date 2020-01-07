<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

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
     * @return BelongsTo
     */
    public function actionModule()
    {
        return $this->belongsTo('App\ActionModule', 'action_module_id', 'action_module_id');
    }

    /**
     * @return BelongsTo
     */
    public function admin_created()
    {
        return $this->belongsTo('App\Admin', 'admin_created_by', 'admin_id');
    }

    /**
     * @return BelongsTo
     */
    public function admin_updated()
    {
        return $this->belongsTo('App\Admin', 'admin_updated_by', 'admin_id');
    }

    /**
     * @return HasMany
     */
    public function brands_created()
    {
        return $this->hasMany('App\Brand', 'brand_created_by', 'admin_id');
    }

    /**
     * @return HasMany
     */
    public function brands_updated()
    {
        return $this->hasMany('App\Brand', 'brand_updated_by', 'admin_id');
    }

    /**
     * @return HasMany
     */
    public function brandCategories_created()
    {
        return $this->hasMany('App\BrandCategory', 'brand_category_created_by', 'admin_id');
    }

    /**
     * @return HasMany
     */
    public function brandCategories_updated()
    {
        return $this->hasMany('App\BrandCategory', 'brand_category_updated_by', 'admin_id');
    }

    /**
     * @return HasMany
     */
    public function categories_created()
    {
        return $this->hasMany('App\Category', 'category_created_by', 'admin_id');
    }

    /**
     * @return HasMany
     */
    public function categories_updated()
    {
        return $this->hasMany('App\Category', 'category_updated_by', 'admin_id');
    }

    /**
     * @return HasMany
     */
    public function galleries_created()
    {
        return $this->hasMany('App\Gallery', 'gallery_created_by', 'admin_id');
    }

    /**
     * @return HasMany
     */
    public function galleries_updated()
    {
        return $this->hasMany('App\Gallery', 'gallery_updated_by', 'admin_id');
    }

    /**
     * @return HasMany
     */
    public function images_created()
    {
        return $this->hasMany('App\Image', 'image_created_by', 'admin_id');
    }

    /**
     * @return HasMany
     */
    public function images_updated()
    {
        return $this->hasMany('App\Image', 'image_updated_by', 'admin_id');
    }

    /**
     * @return HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order', 'order_updated_by', 'admin_id');
    }

    /**
     * @return HasMany
     */
    public function products_created()
    {
        return $this->hasMany('App\Product', 'product_created_by', 'admin_id');
    }

    /**
     * @return HasMany
     */
    public function products_updated()
    {
        return $this->hasMany('App\Product', 'product_updated_by', 'admin_id');
    }

    /**
     * @return HasMany
     */
    public function slides_created()
    {
        return $this->hasMany('App\Slide', 'slide_created_by', 'admin_id');
    }

    /**
     * @return HasMany
     */
    public function slides_updated()
    {
        return $this->hasMany('App\Slide', 'slide_updated_by', 'admin_id');
    }

    /**
     * @param string $adminEmail
     * @param string $adminPassword
     * @return Model|Builder|object|null
     */
    public static function getAdminByEmailPassword($adminEmail, $adminPassword)
    {
        $adminEmail = trim($adminEmail);
        $adminPassword = trim($adminPassword);

        return DB::table(Constant::TABLE_ADMIN)
            ->where(
                Constant::TABLE_ADMIN . '.admin_email',
                '=',
                $adminEmail
            )
            ->where(
                Constant::TABLE_ADMIN . '.admin_password',
                '=',
                md5($adminPassword)
            )
            ->first();
    }

    /**
     * @param int $adminId
     * @return Model|Builder|object|null
     */
    public static function getById($adminId)
    {
        $adminId = intval($adminId);
        return DB::table(Constant::TABLE_ADMIN)
            ->where(
                Constant::TABLE_ADMIN . '.admin_id',
                '=',
                $adminId
            )
            ->first();
    }

    /**
     * @return Builder
     */
    public static function getAll()
    {
        return DB::table(Constant::TABLE_ADMIN)
            ->where(
                Constant::TABLE_ADMIN . '.admin_is_deleted',
                '=',
                0
            );
    }

    /**
     * @param int $adminId
     * @param array $arrData
     */
    public static function updateByAdminId($adminId, $arrData)
    {
        $adminId = intval($adminId);
        DB::table(Constant::TABLE_ADMIN)
            ->where(
                Constant::TABLE_ADMIN . '.admin_id',
                '=',
                $adminId
            )
            ->update($arrData);
    }

    /**
     * @param string $adminEmail
     * @return Model|Builder|object|null
     */
    public static function getByEmail($adminEmail)
    {
        $adminEmail = trim($adminEmail);
        return DB::table(Constant::TABLE_ADMIN)
            ->where(
                Constant::TABLE_ADMIN . '.admin_email',
                '=',
                $adminEmail
            )
            ->first();
    }

    /**
     * @param array $arrData
     * @return bool
     */
    public static function insertAdminAndGetId($arrData)
    {
        return DB::table(Constant::TABLE_ADMIN)
            ->insertGetId($arrData);
    }
}
