<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
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

        

        Unit::factory(30)->create();

        Store::factory(5)->create();

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

                Product::factory(5)->create([
                    'category_id' => $parentCategory->id,
                    'supplier_id' => $supplier->id
                ]);
            });
        });
        
    }
}
