<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Schema::compileForeign();
        $this->call(AdminSeeder::class);
        $this->call(PhimSeeder::class);
        $this->call(ConfigSeeder::class);
        $this->call(PhongSeeder::class);
        $this->call(GheSeeder::class);
        $this->call(LichChieuSeeder::class);
        $this->call(GheBanSeeder::class);
        // Schema::enableForeignKeyConstraints();
    }
}
