<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
