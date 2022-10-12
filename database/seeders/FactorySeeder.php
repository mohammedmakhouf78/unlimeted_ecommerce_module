<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Profile;
use App\Models\Store;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create()->each(function($user){
            Profile::factory()->create([
                'profilable_type' => User::class,
                'profilable_id' => $user->id
            ]);
        });

        

        

        Category::factory(3)->create()->each(function($parentCategory){

            Category::factory(3)->create([
                'parent_id' => $parentCategory->id
            ])->each(function($childCategory){
                Category::factory(3)->create([
                    'parent_id' => $childCategory->id
                ]);
            });

            Supplier::factory(3)->create()->each(function($supplier) use($parentCategory){
                Profile::factory()->create([
                    'profilable_type' => Supplier::class,
                    'profilable_id' => $supplier->id
                ]);


                Store::factory(3)->create()->each(function($store) use ($supplier,$parentCategory){

                    Unit::factory(4)->create()->each(function($unit) use ($supplier,$parentCategory, $store){

                        Product::factory(1)->create([
                            'category_id' => $parentCategory->id,
                            'supplier_id' => $supplier->id
                        ])->each(function($product) use($unit,$store){

                            ProductDetail::factory(1)->create([
                                'product_id' => $product->id,
                                'unit_id' => $unit->id,
                                'store_id' => $store->id
                            ]);
                        });
                    });
                });
                
            });
        });
        
    }
}
