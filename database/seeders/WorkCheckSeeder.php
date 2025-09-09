<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Only create work checks if we have staff and documents
        $staffCount = \App\Models\Staff::count();
        $documentCount = \App\Models\Document::count();

        if ($staffCount > 0 && $documentCount > 0) {
            \App\Models\WorkCheck::factory(10)->create();
        }
    }
}
