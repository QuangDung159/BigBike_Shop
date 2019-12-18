<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionModuleSeeding extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listAction = DB::table('action')->get();
        $listModule = DB::table('module')->get();

        $count = 1;
        foreach ($listAction as $action) {
            foreach ($listModule as $module) {
                $data = [];
                $data['action_id'] = $action->action_id;
                $data['module_id'] = $module->module_id;
                $data['action_module_id'] = $count;
                DB::table('action_module')->insert($data);
                $count++;
            }
        }
    }
}
