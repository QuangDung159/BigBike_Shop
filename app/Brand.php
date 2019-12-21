<?php

namespace App;

use Egulias\EmailValidator\Exception\ConsecutiveAt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

/**
 * @property int $brand_id
 * @property int $brand_created_by
 * @property int $brand_updated_by
 * @property string $brand_name
 * @property string $brand_desc
 * @property string $brand_logo
 * @property int $brand_created_at
 * @property int $brand_updated_at
 * @property boolean $brand_status
 * @property boolean $brand_is_deleted
 * @property Admin $admin
 * @property Admin $admin
 * @property BrandCategory[] $brandCategories
 */
class Brand extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'brand';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'brand_id';

    /**
     * @var array
     */
    protected $fillable = ['brand_created_by', 'brand_updated_by', 'brand_name', 'brand_desc', 'brand_logo', 'brand_created_at', 'brand_updated_at', 'brand_status', 'brand_is_deleted'];

    /**
     * @return BelongsTo
     */
    public function admin_created()
    {
        return $this->belongsTo('App\Admin', 'brand_created_by', 'admin_id');
    }

    /**
     * @return BelongsTo
     */
    public function admin_updated()
    {
        return $this->belongsTo('App\Admin', 'brand_updated_by', 'admin_id');
    }

    /**
     * @return HasMany
     */
    public function brandCategories()
    {
        return $this->hasMany('App\BrandCategory', 'brand_id', 'brand_id');
    }

    public static function updateByBrandId($brandId, $arrData)
    {
        $brandId = intval($brandId);
        DB::table(Constant::TABLE_BRAND)
            ->where(
                Constant::TABLE_BRAND . '.brand_id',
                '=',
                $brandId
            )
            ->update($arrData);

        Redis::del('list_brand');
    }

    public static function insert($data)
    {
        DB::table(Constant::TABLE_BRAND)
            ->insert(
                $data
            );
        Redis::del('list_brand');
    }
}
