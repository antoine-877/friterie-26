<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Une catégorie et ses produits triés par nom, ou une page 404 si l'id n'existe pas.
     */
    public function show(Category $category): View
    {
        $products = $category->products()->with('allergens')->orderBy('name')->get();

        return view('categories.show', ['category' => $category, 'products' => $products]);
    }

    public function storeProduct(ProductRequest $request, Category $category): RedirectResponse
    {
        $category->products()->create($request->validated());

        return redirect()->route('categories.show', $category->id)->with('status', 'Le produit a été ajouté.');
    }
}
