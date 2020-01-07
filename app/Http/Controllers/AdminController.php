<?php

namespace App\Http\Controllers;

use App\Action;
use App\Admin;
use App\Constant;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * @return Factory|View
     */
    public function showAdminLoginPage()
    {
        return view(Constant::PATH_ADMIN_ADMIN_LOGIN);
    }

    /**
     * @param Request $req
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function doLogin(Request $req)
    {
        $adminEmail = $req->admin_email;
        $adminPassword = $req->admin_password;

        $this->validate($req,
            [
                'admin_email' => 'required',
                'admin_password' => 'required'
            ],
            [
                'admin_email.required' => 'Please enter your email',
                'admin_password' => 'Please enter your password'
            ]
        );

        $admin = Admin::getAdminByEmailPassword($adminEmail, $adminPassword);
        if ($admin) {
            Session::put('admin_id', $admin->admin_id);
            Return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        } else {
            Session::put('msg_login_fail', 'Login fail! Please check your information.');
            return Redirect::to(Constant::URL_ADMIN_LOGIN);
        }
    }

    /**
     * @return RedirectResponse
     */
    public function doLogout()
    {
        Session::forget('admin_id');
        return Redirect::to(Constant::URL_ADMIN_LOGIN);
    }

    /**
     * @return Factory|View
     */
    public function showListPage()
    {
        $listAdminToShow = Admin::getAll()
            ->orderBy(Constant::TABLE_ADMIN . '.admin_created_at', 'desc')
            ->paginate(10);

        $listAdmin = Admin::getAll()->get();

        $listAdmin = HelperController::convertStdToArray($listAdmin);

        $arrAssocAdmin = array_column($listAdmin, 'admin_name', 'admin_id');

        return view(Constant::PATH_ADMIN_ADMIN_LIST)
            ->with('listAdminToShow', $listAdminToShow)
            ->with('assocAdmin', $arrAssocAdmin);
    }

    /**
     * @param int $adminId
     * @param int $status
     * @return RedirectResponse
     */
    public function changeStatus($adminId, $status)
    {
        $data = [];

        if ($status == 0) {
            $data['admin_status'] = 1;
        } else {
            $data['admin_status'] = 0;
        }

        if ($adminId == Session::get('admin_id')) {
            Session::put('msg_cannot_update_status_yourself', 'Sorry, you cannot update your status.');
            return Redirect::to(Constant::URL_ADMIN_ADMIN . '/read');
        }

        $data['admin_updated_at'] = time();
        $data['admin_updated_by'] = Session::get('admin_id');

        Admin::updateByAdminId($adminId, $data);

        Session::put('msg_update_success', 'Update admin successfully!');

        return Redirect::to(Constant::URL_ADMIN_ADMIN . '/read');
    }

    /**
     * @return Factory|View
     */
    public function showCreateAdminPage()
    {
        $listModule = $this->getModuleWithAction();
        return view(Constant::PATH_ADMIN_ADMIN_CREATE)
            ->with('listModule', $listModule);
    }

    public function doCreateAdmin(Request $req)
    {
        $this->validate($req,
            [
                'admin_name' => 'required',
                'admin_email' => 'required',
                'admin_password' => 'required',
            ],
            [
                'admin_name.required' => 'Please enter admin name',
                'admin_email.required' => 'Please enter admin email',
                'admin_password.required' => 'Please enter admin password',
            ]
        );

        $adminName = $req->admin_name;
        $adminEmail = $req->admin_email;
        $adminPassword = $req->admin_password;

        $adminByEmail = Admin::getByEmail($adminEmail);
        if ($adminByEmail) {
            Session::put('msg_email_exist', 'Admin email already existed.');
            return Redirect::to(Constant::URL_ADMIN_ADMIN . '/read');
        }

        $data = [];
        $data['admin_name'] = $adminName;
        $data['admin_password'] = md5($adminPassword);
        $data['admin_email'] = $adminEmail;
        $data['admin_created_at'] = time();
        $data['admin_created_by'] = Session::get('admin_id');

        Admin::insertAdmin($data);

        Session::put('msg_add_success', 'Create admin successfully!');
        return Redirect::to(Constant::URL_ADMIN_ADMIN . '/read');

    }

    /**
     * @return mixed
     */
    public function getModuleWithAction()
    {
        $listModule = json_decode(Redis::get('list_module'));

        $listModule = HelperController::convertStdToArray($listModule);

        foreach ($listModule as $moduleKey => &$moduleItem) {
            $listActionByModule = Action::getActionByModuleId($moduleItem['module_id']);
            $listActionByModule = HelperController::convertStdToArray($listActionByModule);
            $arrAction = [];
            foreach ($listActionByModule as $actionKey => $actionItem) {
                $url = '/admin/' . $moduleItem['module_name'] . '/' . $actionItem['action_name'];
                array_push($arrAction, [
                    'action_name' => $actionItem['action_name'],
                    'action_url' => strtolower($url),
                ]);
            }
            $moduleItem = $moduleItem + ['list_action' => $arrAction];
        }

        return HelperController::convertArrayToStd($listModule);
    }
}
