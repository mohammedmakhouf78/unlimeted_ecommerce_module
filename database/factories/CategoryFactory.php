<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    private static $myCount = 0;
   
    public function definition()
    {
        self::$myCount += 1;
        return [
            'name' => "category_" . self::$myCount,
            'parent_id' => 0
        ];
    }
}
