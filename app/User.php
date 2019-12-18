<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
class user extends Model
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order', 'user_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany('App\Review', 'user_id', 'user_id');
    }
}
