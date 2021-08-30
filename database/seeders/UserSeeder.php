<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run()
    {
        $this->createAdminRecord();
    }

    private function createAdminRecord(): void
    {
        $admin = new User();
        $admin->name = 'Администратор';
        $admin->email = env('ADMIN_LOGIN');
        $admin->password = Hash::make(env('ADMIN_PASSWORD'));
        $admin->email_verified_at = Carbon::now()->toDateTimeString();
        $admin->role = Role::ADMIN();
        $admin->save();
    }
}
