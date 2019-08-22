<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 動作確認用ユーザ
        DB::table('users')->insert([
            'name' => 'sacrament',
            'password' => bcrypt('11111111'),
            'email' => 'sacra@gmail.com',
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today(),
        ]);
        // その他のユーザ100件
        for ($i = 1; $i <= 100; $i++) {
            User::create([
                'name' => 'TestUser' . $i,
                'email' => 'testuser' . $i . '@gmail.com',
                'password' => bcrypt('11111111'),
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today(),
            ]);
        }
    }
}
