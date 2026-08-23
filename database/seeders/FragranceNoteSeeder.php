<?php

namespace Database\Seeders;

use App\Models\FragranceNote;
use Illuminate\Database\Seeder;

class FragranceNoteSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Vanilla', 'Green Tea', 'Musk', 'Citrus', 'Aquatic', 'Woody'] as $name) {
            FragranceNote::firstOrCreate(['name' => $name]);
        }
    }
}
