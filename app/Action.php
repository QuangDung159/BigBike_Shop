<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property int $action_id
 * @property string $action_name
 * @property ActionModule[] $actionModules
 */
class Action extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'action';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'action_id';

    /**
     * @var array
     */
    protected $fillable = ['action_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actionModules()
    {
        return $this->hasMany('App\ActionModule', 'action_id', 'action_id');
    }

    public static function getActionByModuleId($moduleId)
    {
        $moduleId = intval($moduleId);

        return DB::table(Constant::TABLE_ACTION)
            ->select(
                [
                    Constant::TABLE_MODULE . '.module_id',
                    Constant::TABLE_MODULE . '.module_name',
                    Constant::TABLE_ACTION . '.action_id',
                    Constant::TABLE_ACTION . '.action_name'
                ]
            )
            ->join(
                Constant::TABLE_ACTION_MODULE,
                Constant::TABLE_ACTION . '.action_id',
                '=',
                Constant::TABLE_ACTION_MODULE . '.action_id'
            )
            ->join(
                Constant::TABLE_MODULE,
                Constant::TABLE_ACTION_MODULE . '.module_id',
                '=',
                Constant::TABLE_MODULE . '.module_id'
            )
            ->where(
                Constant::TABLE_MODULE . '.module_id',
                '=',
                $moduleId
            )->get();
    }

    public static function getActionByModuleIdAdminId($moduleId, $adminId)
    {
        $moduleId = intval($moduleId);
        $adminId = intval($adminId);

        return DB::table(Constant::TABLE_ACTION)
            ->distinct()
            ->select(
                [
                    Constant::TABLE_MODULE . '.module_id',
                    Constant::TABLE_MODULE . '.module_name',
                    Constant::TABLE_ACTION . '.action_id',
                    Constant::TABLE_ACTION . '.action_name'
                ]
            )
            ->join(
                Constant::TABLE_ACTION_MODULE,
                Constant::TABLE_ACTION . '.action_id',
                '=',
                Constant::TABLE_ACTION_MODULE . '.action_id'
            )
            ->join(
                Constant::TABLE_MODULE,
                Constant::TABLE_ACTION_MODULE . '.module_id',
                '=',
                Constant::TABLE_MODULE . '.module_id'
            )
            ->join(
                Constant::TABLE_ADMIN_ACTION_MODULE,
                Constant::TABLE_ACTION_MODULE . '.action_module_id',
                '=',
                Constant::TABLE_ACTION_MODULE . '.action_module_id'
            )
            ->where(
                Constant::TABLE_ADMIN_ACTION_MODULE . '.admin_id',
                '=',
                $adminId
            )
            ->where(
                Constant::TABLE_MODULE . '.module_id',
                '=',
                $moduleId
            )->get();
    }

    public static function getByName($actionName)
    {
        $actionName = trim($actionName);

        return DB::table(Constant::TABLE_ACTION)
            ->where(
                Constant::TABLE_ACTION . '.action_name',
                '=',
                $actionName
            )->first();
    }
}
