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
        DB::table('admin')->insert(
            [
                [
                    'admin_id' => 1,
                    'admin_name' => 'Root Admin',
                    'admin_email' => 'root@email.com',
                    'admin_password' => md5('123'),
                    'admin_is_root' => 1,
                    'admin_created_at' => time(),
                ],
                [
                    'admin_id' => 2,
                    'admin_name' => 'Sub Admin',
                    'admin_email' => 'sub1@email.com',
                    'admin_password' => md5('123'),
                    'admin_is_root' => 1,
                    'admin_created_at' => time(),
                ]
            ]
        );

        DB::table('shipping_status')->insert(
            [
                [
                    'shipping_status_id' => 1,
                    'shipping_status_name' => 'Received'
                ],
                [
                    'shipping_status_id' => 2,
                    'shipping_status_name' => 'In process'
                ],
                [
                    'shipping_status_id' => 3,
                    'shipping_status_name' => 'In transit'
                ],
                [
                    'shipping_status_id' => 4,
                    'shipping_status_name' => 'Delivered'
                ]
            ]
        );

        DB::table('module')->insert(
            [
                [
                    'module_id' => 1,
                    'module_name' => 'Brand',
                ],
                [
                    'module_id' => 2,
                    'module_name' => 'Category',
                ],
                [
                    'module_id' => 3,
                    'module_name' => 'User',
                ],
                [
                    'module_id' => 4,
                    'module_name' => 'Product',
                ],
                [
                    'module_id' => 5,
                    'module_name' => 'Review',
                ],
                [
                    'module_id' => 6,
                    'module_name' => 'Slide',
                ],
                [
                    'module_id' => 7,
                    'module_name' => 'Admin',
                ],
                [
                    'module_id' => 8,
                    'module_name' => 'Order',
                ],
                [
                    'module_id' => 9,
                    'module_name' => 'Image',
                ],
                [
                    'module_id' => 10,
                    'module_name' => 'Brand - Category',
                ],
                [
                    'module_id' => 11,
                    'module_name' => 'Gallery',
                ],
                [
                    'module_id' => 12,
                    'module_name' => 'ACL',
                ],
            ]
        );

        DB::table('action')->insert(
            [
                [
                    'action_id' => 1,
                    'action_name' => 'Create'
                ],
                [
                    'action_id' => 2,
                    'action_name' => 'Read'
                ],
                [
                    'action_id' => 3,
                    'action_name' => 'Update'
                ],
                [
                    'action_id' => 4,
                    'action_name' => 'Delete'
                ],
            ]
        );

        $this->call(ActionModuleSeeding::class);
        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(BrandCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(GallerySeeder::class);
        $this->call(ImageGallerySeeder::class);
        $this->call(SlideSeeder::class);
        $this->call(ProductThumbnailSeeder::class);
        $this->call(RootAdminActionModuleSeeder::class);
    }
}
