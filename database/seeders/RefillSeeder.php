<?php

namespace Database\Seeders;

use App\Models\Refill;
use Illuminate\Database\Seeder;

class RefillSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Aventus',
            'Acqua Di Gio',
            'Allure Homme Sport',
            'Baccarat Rouge 540',
            'Bleu de Chanel',
            'Black Opium',
            'Coco Mademoiselle',
            'Dior Sauvage',
            'Erba Pura',
            'Good Girl',
            'Him',
            'Invictus',
            'Jasmin Rouge',
            'Kirke',
            'La Vie Est Belle',
            'Le Male',
            'Musc Ravageur',
            'Noir Extreme',
            'Oud Wood',
            'Portrait of a Lady',
            'Rose Nacree du Desert',
            'Santal 33',
            'Tobacco Vanille',
            'Wood Sage & Sea Salt',
        ];

        foreach ($names as $index => $name) {
            Refill::updateOrCreate(
                ['name' => $name],
                ['is_active' => true, 'sort_order' => $index + 1]
            );
        }
    }
}
