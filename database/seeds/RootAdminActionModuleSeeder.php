<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RootAdminActionModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listActionModule = DB::table('action_module')->get();
        foreach ($listActionModule as $key => $actionModuleItem) {
            $data = [];
            $data['admin_action_module_id'] = $key + 1;
            $data['admin_id'] = 1;
            $data['action_module_id'] = $actionModuleItem->action_module_id;
            $data['admin_action_module_created_by'] = 1;
            $data['admin_action_module_created_at'] = time();
            DB::table('admin_action_module')->insert($data);
        }
    }
}
