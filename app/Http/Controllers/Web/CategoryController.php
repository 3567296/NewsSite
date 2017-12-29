<?php

namespace App\Http\Controllers\Web;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function category($category)
    {
        $category = Category::where('slug', $category)->first();

        if (!$category) {
            abort(404);
        }

        $posts = $category->posts()->paginate(5);

        return view("categories.index", compact('posts', 'categoryName'));
    }
}
