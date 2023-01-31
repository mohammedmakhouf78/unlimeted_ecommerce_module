<?php

namespace App\Http\Traits;

use App\Models\Category;
use Illuminate\Support\Facades\Redis;

trait CategoryTrait
{
    private function setCategoriesInRedis()
    {
        $redis = Redis::connection();

        $categories = Category::select([
            'id','name','parent_id'
        ])->get();

        $redis->set('categories', $categories);
    }

    private function getCategoriesFromRedis()
    {
        $redis = Redis::connection();

        if($categories = json_decode($redis->get('categories')))
        {
            return $categories;
        }

        return Category::select([
            'id','name','parent_id'
        ])->get();
    }

    private function removeCategoriesFromRedis()
    {
        $redis = Redis::connection();

        $redis->del('categories');
    }

    private function generateNestedCategories($categories)
    {
        static $s = "";

        $s .= "<ul>";

        foreach($categories as $category)
        {
            $s .= "<li>";
            $s .= $category->name;

            if($category->subCategories)
            {
                $this->generateNestedCategories($category->subCategories);
            }

            $s .= "</li>";
        }

        $s .= "</ul>";

        return $s;
    }
}
