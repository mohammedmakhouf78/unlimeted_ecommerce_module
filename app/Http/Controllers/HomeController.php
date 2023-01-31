<?php

namespace App\Http\Controllers;

use App\Http\Traits\CategoryTrait;
use App\Models\Category;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    use CategoryTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // // DB::table('profiles')->truncate();
        // // Profile::create([
        // //     'profilable_type' => Supplier::class,
        // //     'profilable_id' => 1,
        // //     'number_of_orders' => rand(20, 50),
        // //     'number_of_returns' => rand(20, 50),
        // //     'should_pay' => rand(20, 1000),
        // //     'should_be_paid' => rand(20, 1000),
        // // ]);
        // // ddd(Profile::first()->load('profilable'));
        // // $role = Role::updateOrCreate([
        // //     'name' => 'admin'
        // // ],[

        // // ]);

        // // $user = User::first();
        // // $supplier = Supplier::first();
        // // // $user->attachRole($role);
        // // // $supplier->attachRole($role);
        // // dump($supplier->hasRole('admin'));
        // // dump($user->hasRole('admin'));
        // $x = Supplier::limit(5)->with('profile')->get(); 
        // Collection

        // dd($x);

        $categories = Category::where('parent_id', 0)
            ->with('subCategories')
            ->get();

        $categoriesView = $this->generateNestedCategories($categories);

        return view('admin.home',[
            'categories' => $categories,
            'categoriesView' => $categoriesView
        ]);
    }

}
