<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrator = new \App\Models\User;
        $administrator->username = "administrator";
        $administrator->name = "Site Administrator";
        $administrator->email = "administrator@email.test";
        // $administrator->roles = json_encode(["ADMIN"]);
        $administrator->password = \Hash::make("admin123");
        $administrator->avatar = "saat-ini-tidak-ada-file.png";
        $administrator->address = "Bandung selatan";
        $administrator->is_admin = 1;        
        $administrator->save();
        $this->command->info("User Admin berhasil diinsert");
    }
}
