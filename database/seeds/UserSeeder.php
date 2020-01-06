<?php

use App\Constant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                Constant::TABLE_USER . '.user_id' => 1,
                Constant::TABLE_USER . '.user_name' => 'User 1',
                Constant::TABLE_USER . '.user_email' => 'user1@mail.com',
                Constant::TABLE_USER . '.user_password' => md5('123'),
                Constant::TABLE_USER . '.user_address' => 'address 1',
                Constant::TABLE_USER . '.user_phone' => '09999',
                Constant::TABLE_USER . '.user_created_at' => time(),
            ],
            [
                Constant::TABLE_USER . '.user_id' => 2,
                Constant::TABLE_USER . '.user_name' => 'User 2',
                Constant::TABLE_USER . '.user_email' => 'user2@mail.com',
                Constant::TABLE_USER . '.user_password' => md5('123'),
                Constant::TABLE_USER . '.user_address' => 'address 2',
                Constant::TABLE_USER . '.user_phone' => '09999',
                Constant::TABLE_USER . '.user_created_at' => time(),
            ],
        ];
        DB::table(Constant::TABLE_USER)
            ->insert($data);
    }
}
