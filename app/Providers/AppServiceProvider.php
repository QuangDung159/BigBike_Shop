<?php

namespace App\Providers;

use App\Action;
use App\Http\Controllers\HelperController;
use App\Module;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use function foo\func;

session_start();

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $listSort = [
            'Rate : High to low' => '1',
            'Rate : Low to high' => '2',
            'Price : High to low' => '3',
            'Price : Low to high' => 4
        ];
        $listPerPage = [
            'Show 12' => '12',
            'Show 16' => '16',
            'Show 20' => '20'
        ];

        if (!Redis::get('list_sort')) {
            Redis::set('list_sort', json_encode($listSort));
        }

        if (!Redis::get('list_per_page')) {
            Redis::set('list_per_page', json_encode($listPerPage));
        }

        if (!Redis::get('list_module')) {
            $listModuleToCache = Module::getAll();
            Redis::set('list_module', json_encode($listModuleToCache));
        }

        $listModule = HelperController::convertArrayToStd($this->getModuleWithAction());

        view()->composer('admin.layout.master', function ($view) use ($listModule) {
            return $view->with('listModule', $listModule);
        });
    }

    public function getModuleWithAction()
    {
        $listModule = json_decode(Redis::get('list_module'));

        $listModule = HelperController::convertStdToArray($listModule);

        foreach ($listModule as $moduleKey => &$moduleItem) {
            $listActionByModule = Action::getActionByModuleId($moduleItem['module_id']);
            $listActionByModule = HelperController::convertStdToArray($listActionByModule);
            $arrAction = [];
            foreach ($listActionByModule as $actionKey => $actionItem) {
                if ($actionItem['action_name'] != 'Delete' && $actionItem['action_name'] != 'Update') {
                    $url = '/admin/' . $moduleItem['module_name'] . '/' . $actionItem['action_name'];
                    array_push($arrAction, [
                        'action_name' => $actionItem['action_name'],
                        'action_url' => strtolower($url),
                    ]);
                }
            }
            $moduleItem = $moduleItem + ['list_action' => $arrAction];
        }

        return HelperController::convertArrayToStd($listModule);
    }
}
