<?php

namespace Database\Seeders;

use App\Models\Additive;
use Illuminate\Database\Seeder;

class AdditiveSeeder extends Seeder
{
    public function run(): void
    {
        $additives = [
            [
                'e_number' => '100',
                'name' => 'Curcumin',
                'description' => 'Yellow-orange food coloring derived from turmeric.',
                'risk_level' => 'low',
                'common_uses' => 'Butter, cheese, mustard, yogurt, cake mixes, and cereals.'
            ],
            [
                'e_number' => '160a',
                'name' => 'Beta-Carotene',
                'description' => 'Natural pigment found in many fruits and vegetables.',
                'risk_level' => 'low',
                'common_uses' => 'Margarine, cheese, fruit juices, and dairy products.'
            ],
            [
                'e_number' => '300',
                'name' => 'Ascorbic Acid (Vitamin C)',
                'description' => 'Antioxidant and vitamin C supplement.',
                'risk_level' => 'low',
                'common_uses' => 'Fruit juices, bread, cured meats, and cereals.'
            ],
            [
                'e_number' => '322',
                'name' => 'Lecithin',
                'description' => 'Emulsifier derived from soybeans or egg yolks.',
                'risk_level' => 'low',
                'common_uses' => 'Chocolate, baked goods, and margarine.'
            ],
            [
                'e_number' => '330',
                'name' => 'Citric Acid',
                'description' => 'Natural preservative and flavor enhancer.',
                'risk_level' => 'low',
                'common_uses' => 'Soft drinks, jams, and canned fruits.'
            ],
            [
                'e_number' => '407',
                'name' => 'Carrageenan',
                'description' => 'Thickening agent derived from seaweed.',
                'risk_level' => 'moderate',
                'common_uses' => 'Dairy products, plant milks, and processed meats.'
            ],
            [
                'e_number' => '621',
                'name' => 'Monosodium Glutamate (MSG)',
                'description' => 'Flavor enhancer that provides umami taste.',
                'risk_level' => 'moderate',
                'common_uses' => 'Processed foods, snacks, and restaurant foods.'
            ],
            [
                'e_number' => '951',
                'name' => 'Aspartame',
                'description' => 'Artificial sweetener.',
                'risk_level' => 'moderate',
                'common_uses' => 'Diet sodas, sugar-free products, and chewing gum.'
            ],
            [
                'e_number' => '102',
                'name' => 'Tartrazine',
                'description' => 'Yellow food dye.',
                'risk_level' => 'high',
                'common_uses' => 'Candy, soft drinks, and processed snacks.'
            ],
            [
                'e_number' => '129',
                'name' => 'Allura Red AC',
                'description' => 'Red food dye.',
                'risk_level' => 'high',
                'common_uses' => 'Beverages, desserts, and condiments.'
            ]
        ];

        foreach ($additives as $additive) {
            Additive::updateOrCreate(
                ['e_number' => $additive['e_number']],
                $additive
            );
        }
    }
}
