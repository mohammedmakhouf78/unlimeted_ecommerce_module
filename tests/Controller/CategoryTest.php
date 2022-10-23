<?php

namespace Tests\Controller;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function testCategoryIndexIsOk()
    {
        $response = $this->call('GET',route('admin.category.index'));
        $response->assertOk();
    }

    public function testCategoryIndexSessionHasNoErrors()
    {
        $response = $this->call('GET',route('admin.category.index'));
        $response->assertSessionHasNoErrors();
    }

    public function testCreateCateogryPageOpensSuccessfully()
    {
        $response = $this->call('GET',route('admin.category.create'));

        $response->assertOk();
        $response->assertViewHas('categories', Category::get());
    }

    public function testStoreFunctionStoresInDatabase()
    {
        $parentCategory = Category::factory()->create();
        $name = fake()->name();
        
        $this->call('POST',route('admin.category.store'),[
            'name' => $name,
            'parent_id' => $parentCategory->id
        ]);

        $this->assertDatabaseHas('categories',[
            'name' => $name,
            'parent_id' => $parentCategory->id
        ]);
    }

    public function testStoreFunctionWithoutSendingParentIdSetsParentIdToZero()
    {
        $name = fake()->name();

        $this->call('POST',route('admin.category.store'),[
            'name' => $name,
        ]);

        $this->assertDatabaseHas('categories',[
            'name' => $name,
            'parent_id' => 0
        ]);
    }


    public function testUpdateFunctionUpdatesSuccessfully()
    {
        $category = Category::factory()->create();
        $parentCategory = Category::factory()->create();
        $name = fake()->name();

        $this->call('PUT',route('admin.category.update',$category->id),[
            'name' => $name,
            'parent_id' => $parentCategory->id
        ]);

        $this->assertDatabaseHas('categories',[
            'name' => $name,
            'parent_id' => $parentCategory->id
        ]);
    }

    public function testDelteFunction()
    {
        $category = Category::factory()->create();

        $this->call('GET',route('admin.category.destroy',$category->id));

        $this->assertDatabaseMissing('categories',[
            'id' => $category->id,
        ]);
    }
}