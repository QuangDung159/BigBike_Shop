<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

/**
 * @property int $admin_action_module_id
 * @property int $admin_id
 * @property int $action_module_id
 * @property int $admin_action_module_created_by
 * @property int $admin_action_module_updated_by
 * @property int $admin_action_module_created_at
 * @property int $admin_action_module_updated_at
 * @property ActionModule $actionModule
 * @property Admin $admin
 * @property Admin $admin
 * @property Admin $admin
 */
class AdminActionModule extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_action_module';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'admin_action_module_id';

    /**
     * @var array
     */
    protected $fillable = ['admin_id', 'action_module_id', 'admin_action_module_created_by', 'admin_action_module_updated_by', 'admin_action_module_created_at', 'admin_action_module_updated_at'];

    /**
     * @return BelongsTo
     */
    public function actionModule()
    {
        return $this->belongsTo('App\ActionModule', null, 'action_module_id');
    }

    /**
     * @return BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo('App\Admin', null, 'admin_id');
    }

    /**
     * @return BelongsTo
     */
    public function admin_created()
    {
        return $this->belongsTo('App\Admin', 'admin_action_module_created_by', 'admin_id');
    }

    /**
     * @return BelongsTo
     */
    public function admin_updated()
    {
        return $this->belongsTo('App\Admin', 'admin_action_module_updated_by', 'admin_id');
    }

    public static function getByAdminIdActionModuleId($adminId, $actionModuleId)
    {
        $adminId = intval($adminId);
        $actionModuleId = intval($actionModuleId);

        return DB::table(Constant::TABLE_ADMIN_ACTION_MODULE)
            ->where(
                Constant::TABLE_ADMIN_ACTION_MODULE . '.admin_id',
                '=',
                $adminId
            )
            ->where(
                Constant::TABLE_ADMIN_ACTION_MODULE . '.action_module_id',
                '=',
                $actionModuleId
            )
            ->first();
    }
}
