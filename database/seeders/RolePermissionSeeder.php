<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view users', 'store user', 'update user', 'active user', 'delete user',
            'view staffs', 'store staff', 'update staff', 'delete staff',
            'view roles', 'store role', 'update role', 'delete role',
            'view permissions', 'store permission', 'update permission', 'delete permission',
            'view settings', 'store settings', 'update settings', 'active settings', 'delete settings',

            'view hadith-books', 'update hadith-book', 'active hadith-book',
            'view hadith-book-translations', 'store hadith-book-translation', 'update hadith-book-translation', 'active hadith-book-translation',
            'view hadith-chapters', 'update hadith-chapter', 'active hadith-chapter',
            'view hadith-chapter-translations', 'store hadith-chapter-translation', 'update hadith-chapter-translation', 'active hadith-chapter-translation',
            'view hadith-verses', 'update hadith-verse', 'active hadith-verse',
            'view hadith-verse-translations', 'store hadith-verse-translation', 'update hadith-verse-translation', 'active hadith-verse-translation',

            'view quran-chapters', 'update quran-chapters', 'active quran-chapters',
            'view quran-chapter-translations', 'store quran-chapter-translation', 'update quran-chapter-translation', 'active quran-chapter-translation',
            'view quran-verses', 'update quran-verse', 'active quran-verse',
            'update quran-verse-translation', 'active quran-verse-translation',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roles = ['Developer', 'Owner', 'Admin', 'Customer'];
        foreach ($roles as $role) {
            $role = Role::create(['name' => $role]);
        }
    }
}
