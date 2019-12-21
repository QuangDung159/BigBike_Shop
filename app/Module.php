<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property int $module_id
 * @property string $module_name
 * @property ActionModule[] $actionModules
 */
class Module extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'module';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'module_id';

    /**
     * @var array
     */
    protected $fillable = ['module_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actionModules()
    {
        return $this->hasMany('App\ActionModule', 'module_id', 'module_id');
    }

    public static function getAll()
    {
        return DB::table(Constant::TABLE_MODULE)->get();
    }
}
