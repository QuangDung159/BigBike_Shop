<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property int $action_module_id
 * @property int $action_id
 * @property int $module_id
 * @property Action $action
 * @property Module $module
 * @property Admin[] $admins
 */
class ActionModule extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'action_module';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'action_module_id';

    /**
     * @var array
     */
    protected $fillable = ['action_id', 'module_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function action()
    {
        return $this->belongsTo('App\Action', null, 'action_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module()
    {
        return $this->belongsTo('App\Module', 'module_id', 'module_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function admins()
    {
        return $this->hasMany('App\Admin', 'action_module_id', 'action_module_id');
    }

    public static function getByActionIdModuleId($actionId, $moduleId)
    {
        $actionId = intval($actionId);
        $moduleId = intval($moduleId);

        return DB::table(Constant::TABLE_ACTION_MODULE)
            ->where(
                Constant::TABLE_ACTION_MODULE . '.action_id',
                '=',
                $actionId
            )
            ->where(
                Constant::TABLE_ACTION_MODULE . '.module_id',
                '=',
                $moduleId
            )->first();
    }
}
