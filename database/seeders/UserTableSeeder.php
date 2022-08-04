<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            $admin = User::create([
                'name'      => 'Administrator',
                'email'     => 'admin@gmail.com',
                'password'  => '$2y$10$MlEwBIw4CYboZEU3IRNGnOOd.7/q8qUGBnG1q1sdog0uWiGANdrvK', //admin
                'email_verified_at' => now(),
                'remember_token' => rand(10, 10000)
            ]);

            $kepala_madrasah = User::create([
                'name'      => 'Kepala Madrasah',
                'email'     => 'kepala_madrasah@gmail.com',
                'password'  => '$2y$10$MlEwBIw4CYboZEU3IRNGnOOd.7/q8qUGBnG1q1sdog0uWiGANdrvK', //admin
                'email_verified_at' => now(),
                'remember_token' => rand(10, 10000)
            ]);

            $kepala_perpus = User::create([
                'name'      => 'Ketua Perpustakaan',
                'email'     => 'perpustakaan@gmail.com',
                'password'  => '$2y$10$MlEwBIw4CYboZEU3IRNGnOOd.7/q8qUGBnG1q1sdog0uWiGANdrvK', //admin
                'email_verified_at' => now(),
                'remember_token' => rand(10, 10000)
            ]);

            $guru = User::create([
                'name'      => 'Guru',
                'email'     => 'guru@gmail.com',
                'password'  => '$2y$10$MlEwBIw4CYboZEU3IRNGnOOd.7/q8qUGBnG1q1sdog0uWiGANdrvK', //admin
                'email_verified_at' => now(),
                'remember_token' => rand(10, 10000)
            ]);

            $siswa = User::create([
                'name'      => 'Siswa',
                'email'     => 'siswa@gmail.com',
                'password'  => '$2y$10$MlEwBIw4CYboZEU3IRNGnOOd.7/q8qUGBnG1q1sdog0uWiGANdrvK', //admin
                'email_verified_at' => now(),
                'remember_token' => rand(10, 10000)
            ]);

            $role_admin = Role::create(['name' => 'admin']);
            $role_kepala_madrasah = Role::create(['name' => 'kepala madrasah']);
            $role_ketua_perpus = Role::create(['name' => 'ketua perpus']);
            $role_guru = Role::create(['name' => 'guru']);
            $role_siswa = Role::create(['name' => 'siswa']);

            $permission_create = Permission::create(['name' => 'create role']);
            $permission_index = Permission::create(['name' => 'read role']);
            $permission_update = Permission::create(['name' => 'update role']);
            $permission_delete = Permission::create(['name' => 'delete role']);
            $permission_konfigurasi = Permission::create(['name' => 'read konfigurasi']);

            $admin->givePermissionTo([
                $permission_create,
                $permission_index,
                $permission_update,
                $permission_delete,
                $permission_konfigurasi
            ]);
           
            $kepala_madrasah->givePermissionTo([
                $permission_index,
            ]);

            $admin->assignRole('admin');
            $admin->assignRole('kepala madrasah');
            $admin->assignRole('ketua perpus');
            $kepala_madrasah->assignRole('kepala madrasah');
            $kepala_perpus->assignRole('ketua perpus');
            $guru->assignRole('guru');
            $siswa->assignRole('siswa');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
