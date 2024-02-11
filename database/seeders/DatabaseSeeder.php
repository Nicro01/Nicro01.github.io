<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\FolderModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        FolderModel::create([
            'name' => 'Root',
            'path' => '/',
        ]);
        FolderModel::create([
            'name' => 'Tailwind Components',
            'path' => '/Tailwind Components',
        ]);

        DB::table('folder_folder_pivot')->insert([
            'folder_id' => 2,
            'parent_id' => 1,
        ]);
    }
}
