<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Constant;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipping_status')->insert(
            [
                [
                    'shipping_status_name' => 'Received'
                ],
                [
                    'shipping_status_name' => 'In process'
                ],
                [
                    'shipping_status_name' => 'In transit'
                ],
                [
                    'shipping_status_name' => 'Delivered'
                ]
            ]
        );

        DB::table('admin')->insert(
            [
                'admin_name' => 'Root Admin',
                'admin_email' => 'root@email.com',
                'admin_password' => md5('123'),
                'admin_is_root' => 1,
                'admin_created_at' => time(),
            ]
        );

        DB::table('module')->insert(
            [
                [
                    'module_name' => 'brand',
                ],
                [
                    'module_name' => 'category',
                ],
                [
                    'module_name' => 'user',
                ],
                [
                    'module_name' => 'product',
                ],
                [
                    'module_name' => 'review',
                ],
                [
                    'module_name' => 'slide',
                ],
                [
                    'module_name' => 'admin',
                ],
                [
                    'module_name' => 'order',
                ],
                [
                    'module_name' => 'image',
                ],
                [
                    'module_name' => 'brand_category',
                ],
                [
                    'module_name' => 'gallery',
                ],
            ]
        );

        DB::table('action')->insert(
            [
                [
                    'action_name' => 'Create'
                ],
                [
                    'action_name' => 'Read'
                ],
                [
                    'action_name' => 'Update'
                ],
                [
                    'action_name' => 'delete'
                ],
            ]
        );

        $this->call(ActionModuleSeeding::class);
    }
}
