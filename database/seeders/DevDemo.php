<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class DevDemo extends Seeder
{
    // prepare the demo database for development and demosite

    public function run()
    {

        Cache::flush();
        Schema::disableForeignKeyConstraints();

        // truncate database tables
        DB::table('users')->truncate();

        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();

        DB::table('media')->truncate();
        DB::table('mediables')->truncate();
        // also clean uploads folder
        File::deleteDirectory(public_path('uploads'));

        DB::table('currencies')->truncate();
        DB::table('units')->truncate();
        DB::table('taxes')->truncate();
        DB::table('warehouses')->truncate();
        DB::table('brands')->truncate();
        DB::table('product_categories')->truncate();
        DB::table('products')->truncate();
        DB::table('parties')->truncate();

        // seeding media, superadmin and roles, permissions and other modules demo data
        $this->call([

            DemoMediaSeeder::class,

            RolePermissionSeeder::class,
            SuperAdminSeeder::class,

            CurrencySeeder::class,
            UnitSeeder::class,
            TaxSeeder::class,
            WarehouseSeeder::class,
            BrandSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            PartySeeder::class,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}