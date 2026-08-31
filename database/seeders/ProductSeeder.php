<?php

namespace Database\Seeders;

use App\Models\FragranceNote;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $vanessence = Product::updateOrCreate(
            ['slug' => 'vanessence'],
            [
                'name' => 'Vanessence',
                'short_description' => 'A warm and elegant fragrance that blends creamy vanilla, delicate florals, and soft musk into a comforting scent that lingers beautifully throughout the day.',
                'description' => "Vanessence opens with a soft creamy vanilla, tempered by delicate green tea and a whisper of musk. It is designed for the moments that call for warmth without excess — an evening dinner, a quiet morning, a signature you return to. The dry-down settles close to the skin, comforting and understated, built to linger beautifully throughout the day without ever announcing itself too loudly.",
                'fragrance_family' => 'Warm / Elegant',
                'category' => 'Eau de Parfum',
                'longevity' => '6-8 hours',
                'price' => 45000,
                'main_accords' => [
                    ['accord' => 'Sweet', 'percent' => 45],
                    ['accord' => 'Floral', 'percent' => 30],
                    ['accord' => 'Powdery', 'percent' => 25],
                ],
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        $vanessenceNotes = FragranceNote::whereIn('name', ['Vanilla', 'Green Tea', 'Musk'])->pluck('id', 'name');

        $vanessence->fragranceNotes()->sync([
            $vanessenceNotes['Green Tea'] => ['position' => 'top'],
            $vanessenceNotes['Vanilla'] => ['position' => 'heart'],
            $vanessenceNotes['Musk'] => ['position' => 'base'],
        ]);

        $dynamyst = Product::updateOrCreate(
            ['slug' => 'dynamyst'],
            [
                'name' => 'Dynamyst',
                'short_description' => 'Crafted for those who embrace an active lifestyle, Dynamyst combines fresh citrus, aquatic accords, and woody musk to create a clean, energetic, and confident signature scent.',
                'description' => "Crafted for those who embrace an active lifestyle, Dynamyst combines fresh citrus, aquatic accords, and a grounded woody musk to create a clean, energetic, and confident signature scent. It performs equally well at sunrise and long after sunset, carrying an effortless brightness that never feels heavy. This is a fragrance for movement, for momentum, for days with no interest in standing still.",
                'fragrance_family' => 'Fresh / Modern',
                'category' => 'Eau de Parfum',
                'longevity' => '5-7 hours',
                'price' => 45000,
                'main_accords' => [
                    ['accord' => 'Fresh', 'percent' => 40],
                    ['accord' => 'Citrus', 'percent' => 35],
                    ['accord' => 'Aquatic', 'percent' => 25],
                ],
                'is_active' => true,
                'sort_order' => 2,
            ]
        );

        $dynamystNotes = FragranceNote::whereIn('name', ['Citrus', 'Aquatic', 'Woody'])->pluck('id', 'name');

        $dynamyst->fragranceNotes()->sync([
            $dynamystNotes['Citrus'] => ['position' => 'top'],
            $dynamystNotes['Aquatic'] => ['position' => 'heart'],
            $dynamystNotes['Woody'] => ['position' => 'base'],
        ]);
    }
}
