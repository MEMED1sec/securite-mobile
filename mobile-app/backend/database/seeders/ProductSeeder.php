<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Additive;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'barcode' => '7622210449283',
                'name' => 'Oreo Original',
                'brand' => 'Oreo',
                'ingredients' => [
                    'Wheat Flour',
                    'Sugar',
                    'Palm Oil',
                    'Rapeseed Oil',
                    'Fat Reduced Cocoa Powder',
                    'Glucose-Fructose Syrup',
                    'Raising Agents',
                    'Salt',
                    'Emulsifier (Soy Lecithin)',
                    'Flavorings'
                ],
                'nutriscore_grade' => 'D',
                'image_url' => 'https://example.com/oreo.jpg',
                'serving_size' => '34g (3 cookies)',
                'allergens' => ['Wheat', 'Gluten', 'Soy']
            ],
            [
                'barcode' => '5449000000996',
                'name' => 'Coca-Cola Original',
                'brand' => 'Coca-Cola',
                'ingredients' => [
                    'Carbonated Water',
                    'Sugar',
                    'Caramel Color (E150d)',
                    'Phosphoric Acid',
                    'Natural Flavors',
                    'Caffeine'
                ],
                'nutriscore_grade' => 'E',
                'image_url' => 'https://example.com/cocacola.jpg',
                'serving_size' => '330ml',
                'allergens' => []
            ],
            [
                'barcode' => '8000500310427',
                'name' => 'Barilla Spaghetti',
                'brand' => 'Barilla',
                'ingredients' => [
                    'Durum Wheat Semolina',
                    'Water'
                ],
                'nutriscore_grade' => 'A',
                'image_url' => 'https://example.com/barilla.jpg',
                'serving_size' => '80g (dry)',
                'allergens' => ['Gluten']
            ],
            [
                'barcode' => '8715700417256',
                'name' => 'Nutella',
                'brand' => 'Ferrero',
                'ingredients' => [
                    'Sugar',
                    'Palm Oil',
                    'Hazelnuts',
                    'Skimmed Milk Powder',
                    'Fat-Reduced Cocoa',
                    'Emulsifier: Lecithins (Soy)',
                    'Vanillin'
                ],
                'nutriscore_grade' => 'E',
                'image_url' => 'https://example.com/nutella.jpg',
                'serving_size' => '15g',
                'allergens' => ['Hazelnuts', 'Milk', 'Soy']
            ],
            [
                'barcode' => '7622300821525',
                'name' => 'Philadelphia Original',
                'brand' => 'Kraft',
                'ingredients' => [
                    'Pasteurized Milk',
                    'Cream',
                    'Salt',
                    'Stabilizers (Carob Bean and/or Xanthan and/or Guar Gums)',
                    'Cheese Culture'
                ],
                'nutriscore_grade' => 'C',
                'image_url' => 'https://example.com/philadelphia.jpg',
                'serving_size' => '30g',
                'allergens' => ['Milk']
            ],
            [
                'barcode' => '8000500213629',
                'name' => 'Barilla Tomato & Basil Sauce',
                'brand' => 'Barilla',
                'ingredients' => [
                    'Tomato Purée',
                    'Tomato',
                    'Onion',
                    'Sunflower Oil',
                    'Sugar',
                    'Salt',
                    'Basil',
                    'Garlic',
                    'Black Pepper',
                    'Citric Acid'
                ],
                'nutriscore_grade' => 'A',
                'image_url' => 'https://example.com/barilla-sauce.jpg',
                'serving_size' => '125g',
                'allergens' => []
            ],
            [
                'barcode' => '5449000051768',
                'name' => 'Pringles Original',
                'brand' => 'Pringles',
                'ingredients' => [
                    'Dried Potatoes',
                    'Vegetable Oils',
                    'Rice Flour',
                    'Wheat Starch',
                    'Emulsifier (Mono- and Diglycerides of Fatty Acids)',
                    'Dextrose',
                    'Salt',
                    'Yeast',
                    'Flavorings'
                ],
                'nutriscore_grade' => 'D',
                'image_url' => 'https://example.com/pringles.jpg',
                'serving_size' => '30g',
                'allergens' => ['Gluten']
            ],
            [
                'barcode' => '7622210713645',
                'name' => 'Milka Alpine Milk Chocolate',
                'brand' => 'Milka',
                'ingredients' => [
                    'Sugar',
                    'Cocoa Butter',
                    'Skimmed Milk Powder',
                    'Cocoa Mass',
                    'Lactose',
                    'Whey Powder',
                    'Milk Fat',
                    'Emulsifier (Soy Lecithin)',
                    'Flavoring'
                ],
                'nutriscore_grade' => 'D',
                'image_url' => 'https://example.com/milka.jpg',
                'serving_size' => '25g',
                'allergens' => ['Milk', 'Soy']
            ],
            [
                'barcode' => '5449000000989',
                'name' => 'Coca-Cola Zero Sugar',
                'brand' => 'Coca-Cola',
                'ingredients' => [
                    'Carbonated Water',
                    'Color (Caramel E150d)',
                    'Phosphoric Acid',
                    'Sweeteners (Acesulfame K, Aspartame)',
                    'Natural Flavorings',
                    'Caffeine',
                    'Acidity Regulator (Sodium Citrate)'
                ],
                'nutriscore_grade' => 'B',
                'image_url' => 'https://example.com/cocacola-zero.jpg',
                'serving_size' => '330ml',
                'allergens' => []
            ],
            [
                'barcode' => '8000500207239',
                'name' => 'Barilla Whole Grain Pasta',
                'brand' => 'Barilla',
                'ingredients' => [
                    'Wholegrain Durum Wheat Semolina',
                    'Water'
                ],
                'nutriscore_grade' => 'A',
                'image_url' => 'https://example.com/barilla-wholegrain.jpg',
                'serving_size' => '80g (dry)',
                'allergens' => ['Gluten']
            ]
        ];

        $additiveRelations = [
            '7622210449283' => ['322'],  // Oreo (Soy Lecithin)
            '5449000000996' => ['150d'], // Coca-Cola (Caramel Color)
            '8715700417256' => ['322'],  // Nutella (Soy Lecithin)
            '7622300821525' => ['410', '412', '415'], // Philadelphia (Carob Bean, Guar, Xanthan)
            '5449000051768' => ['471'],  // Pringles (Mono- and Diglycerides)
            '7622210713645' => ['322'],  // Milka (Soy Lecithin)
            '5449000000989' => ['150d', '950', '951'] // Coke Zero (Caramel, Acesulfame K, Aspartame)
        ];

        foreach ($products as $productData) {
            $ingredients = $productData['ingredients'];
            unset($productData['ingredients']);
            $allergens = $productData['allergens'];
            unset($productData['allergens']);

            $product = Product::updateOrCreate(
                ['barcode' => $productData['barcode']],
                array_merge($productData, [
                    'ingredients' => $ingredients,
                    'allergens' => $allergens
                ])
            );

            // Attach additives if any
            if (isset($additiveRelations[$product->barcode])) {
                $additiveIds = Additive::whereIn('e_number', $additiveRelations[$product->barcode])->pluck('id')->toArray();
                $product->additives()->sync($additiveIds);
            }
        }
    }
}
