<?php

namespace App\Http\Controllers;

use App\ActionModule;
use App\AdminActionModule;
use App\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AclController extends Controller
{
    public function doCreateAcl(Request $req)
    {
        $data = json_decode($req->data);
        $adminId = $req->admin_id;

        foreach ($data as $key => $item) {
            if ($item->status == true) {
                $actionModule = ActionModule::getByActionIdModuleId($item->action_id, $item->module_id);
                if (!$actionModule) {
                    continue;
                }
                $arrData = [];
                $arrData['action_module_id'] = $actionModule->action_module_id;
                $arrData['admin_id'] = $adminId;
                $arrData['admin_action_module_created_at'] = time();
                $arrData['admin_action_module_created_by'] = Session::get('admin_id');
                AdminActionModule::insert($arrData);
            }
        }

        return response()->json(
            [
                'url' => Constant::URL_ADMIN_ADMIN . '/read',
            ], 200
        );
    }
}
