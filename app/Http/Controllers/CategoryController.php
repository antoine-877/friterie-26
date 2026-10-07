<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Une catégorie et ses produits triés par nom, ou une page 404 si l'id n'existe pas.
     */
    public function show(int $id): View
    {
        $category = Category::findOrFail($id);
        $products = $category->products()->with('allergens')->orderBy('name')->get();

        return view('categories.show', ['category' => $category, 'products' => $products]);
    }
}
