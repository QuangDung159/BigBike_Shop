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

    public static function getByAdminId($adminId)
    {
        $adminId = intval($adminId);
        return DB::table(Constant::TABLE_MODULE)
            ->distinct()
            ->select(
                [
                    Constant::TABLE_MODULE . '.module_id',
                    Constant::TABLE_MODULE . '.module_name',
                    Constant::TABLE_MODULE . '.module_alias',
                ]
            )
            ->join(
                Constant::TABLE_ACTION_MODULE,
                Constant::TABLE_MODULE . '.module_id',
                '=',
                Constant::TABLE_ACTION_MODULE . '.module_id'
            )
            ->join(
                Constant::TABLE_ADMIN_ACTION_MODULE,
                Constant::TABLE_ACTION_MODULE . '.action_module_id',
                '=',
                Constant::TABLE_ADMIN_ACTION_MODULE . '.action_module_id'
            )
            ->where(
                Constant::TABLE_ADMIN_ACTION_MODULE . '.admin_id',
                '=',
                $adminId
            )->get();
    }

    public static function getByName($moduleAlias)
    {
        $moduleAlias = trim($moduleAlias);

        return DB::table(Constant::TABLE_MODULE)
            ->where(
                Constant::TABLE_MODULE . '.module_alias',
                '=',
                $moduleAlias
            )->first();
    }
}
