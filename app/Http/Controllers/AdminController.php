<?php

namespace App\Http\Controllers;

use App\Action;
use App\Admin;
use App\AdminActionModule;
use App\Constant;
use App\Module;
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

    /**
     * @param Request $req
     * @return RedirectResponse
     * @throws ValidationException
     */
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
            return Redirect::to(Constant::URL_ADMIN_ADMIN . '/create');
        }

        $data = [];
        $data['admin_name'] = $adminName;
        $data['admin_password'] = md5($adminPassword);
        $data['admin_email'] = $adminEmail;
        $data['admin_created_at'] = time();
        $data['admin_created_by'] = Session::get('admin_id');

        $adminId = Admin::insertAdminAndGetId($data);

        if (!$adminId) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        $adminData = Admin::getById($adminId);
        if (!$adminData) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        Session::put('msg_add_success', 'Create admin successfully!');
        return Redirect::to(Constant::URL_ADMIN_ADMIN . '/create')
            ->with('admin', $adminData);

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
                    'action_id' => $actionItem['action_id'],
                ]);
            }
            $moduleItem = $moduleItem + ['list_action' => $arrAction];
        }

        return HelperController::convertArrayToStd($listModule);
    }

    /**
     * @param int $adminId
     * @return RedirectResponse
     */
    public function deleteAdmin($adminId)
    {
        if (!$adminId) {
            return Redirect::to(Constant::URL_ADMIN_ADMIN . '/read');
        }

        $admin = Admin::getById($adminId);

        $data = [];
        $data['admin_updated_at'] = time();
        $data['admin_email'] = $admin->admin_email . '.removed';
        $data['admin_updated_by'] = Session::get('admin_id');
        $data['admin_is_deleted'] = 1;

        Admin::updateByAdminId($adminId, $data);
        Session::put('msg_delete_success', 'Delete admin successfully!');

        return Redirect::to(Constant::URL_ADMIN_ADMIN . '/read');
    }

    /**
     * @param int $adminId
     * @return Factory|RedirectResponse|View
     */
    public function showDetailPage($adminId)
    {
        if (!$adminId) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        $admin = Admin::getByIdIsNotDeleted($adminId);
        if (!$admin) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        $listActionModule = $this->getListActionModuleByAdminId($adminId);

        return view(Constant::PATH_ADMIN_ADMIN_DETAIL)
            ->with('admin', $admin)
            ->with('listActionModule', $listActionModule);
    }

    /**
     * @param int $adminId
     * @return mixed
     */
    public function getListActionModuleByAdminId($adminId)
    {
        $listActionModule = $this->getModuleWithAction();
        $listActionModuleByAdmin = HelperController::convertStdToArray(AdminActionModule::getListActionModuleByAdminId($adminId));

        $arrActionModule = [];
        foreach ($listActionModuleByAdmin as $key => $item) {
            array_push($arrActionModule, [$item['action_id'], $item['module_id']]);
        }

        // check [action, module] in admin_action_module get from db
        foreach ($listActionModule as $key => $module) {
            foreach ($module->list_action as $actionKey => &$action) {
                $action = HelperController::convertStdToArray($action);
                if (in_array(array($action['action_id'], $module->module_id), $arrActionModule)) {
                    $action = $action + ['is_active' => 1];
                } else {
                    $action = $action + ['is_active' => 0];
                }
                $action = HelperController::convertArrayToStd($action);
            }
        }

        return $listActionModule;
    }

    /**
     * @param int $adminId
     * @return Factory|RedirectResponse|View
     */
    public function showEditPage($adminId)
    {
        if (!$adminId) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        $admin = Admin::getByIdIsNotDeleted($adminId);
        if (!$admin) {
            return Redirect::to(Constant::URL_ADMIN_DASHBOARD);
        }

        $listAclByAdminId = $this->getListActionModuleByAdminId($adminId);

        return view(Constant::PATH_ADMIN_ADMIN_EDIT)
            ->with('admin', $admin)
            ->with('listAcl', $listAclByAdminId);
    }

    /**
     * @param Request $req
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function doEditAdmin(Request $req)
    {
        $this->validate(
            $req,
            [
                'admin_name' => 'required',
                'admin_email' => 'required',
                'admin_id' => 'required',
            ],
            [
                'admin_name.required' => 'Please enter admin name',
                'admin_email.required' => 'Please enter admin email',
                'admin_id.required' => 'Please enter admin id',
            ]
        );

        $adminName = $req->admin_name;
        $adminEmail = $req->admin_email;
        $adminId = $req->admin_id;

        $adminByEmail = Admin::getByEmail($adminEmail);
        if ($adminByEmail && $adminByEmail->admin_id != $adminId) {
            Session::put('msg_email_exist', 'Admin email already existed.');
            return Redirect::to(Constant::URL_ADMIN_ADMIN . '/update/' . $adminId);
        }

        $data = [];
        $data['admin_name'] = $adminName;
        $data['admin_email'] = $adminEmail;
        $data['admin_updated_at'] = time();
        $data['admin_updated_by'] = Session::get('admin_id');

        Admin::updateByAdminId($adminId, $data);

        Session::put('msg_update_success', 'Update admin successfully!');

        return Redirect::to(Constant::URL_ADMIN_ADMIN . '/update/' . $adminId);
    }
}
