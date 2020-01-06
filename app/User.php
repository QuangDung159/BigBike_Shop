<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

/**
 * @property int $user_id
 * @property string $user_name
 * @property string $user_email
 * @property string $user_password
 * @property string $user_address
 * @property string $user_phone
 * @property int $user_created_at
 * @property int $user_updated_at
 * @property Order[] $orders
 * @property Review[] $reviews
 */
class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * @var array
     */
    protected $fillable = ['user_name', 'user_email', 'user_password', 'user_address', 'user_phone', 'user_created_at', 'user_updated_at'];

    /**
     * @return HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order', 'user_id', 'user_id');
    }

    /**
     * @return HasMany
     */
    public function reviews()
    {
        return $this->hasMany('App\Review', 'user_id', 'user_id');
    }

    /**
     * @return Builder
     */
    public static function getAll()
    {
        return DB::table(Constant::TABLE_USER);
    }
}
