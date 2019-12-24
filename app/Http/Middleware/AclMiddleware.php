<?php

namespace App\Http\Middleware;

use App\Action;
use App\ActionModule;
use App\AdminActionModule;
use App\Constant;
use App\Module;
use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AclMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        print_r($request->url());
//        die;

        $url = $request->url();
        $arrFragment = explode('/', $url);

        /*
        [0] => http:
        [1] =>
        [2] => localhost:8000
        [3] => admin
        [4] => brand
        [5] => create
        */

        if (!empty($arrFragment[5]) && !empty($arrFragment[4])) {
            $actionId = Action::getByName($arrFragment[5])->action_id;
            $moduleId = Module::getByName($arrFragment[4])->module_id;
            if ($this->checkAclByAdminId(Session::get('admin_id'), $actionId, $moduleId)) {
                return $next($request);
            } else {
                return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
            }
        } else {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }
    }

    public function checkAclByAdminId($adminId, $actionId, $moduleId)
    {
        $actionModule = ActionModule::getByActionIdModuleId($actionId, $moduleId);
        $actionModuleId = $actionModule->action_module_id;

        $adminActionModule = AdminActionModule::getByAdminIdActionModuleId($adminId, $actionModuleId);
        if ($adminActionModule) {
            return true;
        } else {
            return false;
        }
    }
}
