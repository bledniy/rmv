<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(LanguageTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(AdminMenuSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(TranslateTableSeeder::class);
        $this->call(RedirectsTableSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(FacultiesTableSeeder::class);
    }
}
