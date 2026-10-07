<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * La carte : les catégories dans l'ordre de position, chacune avec ses produits triés par nom.
     * with() charge les produits et leurs allergènes en trois requêtes, quel que soit leur nombre.
     */
    public function index(): View
    {
        $categories = Category::with([
            'products' => fn ($query) => $query->orderBy('name'),
            'products.allergens',
        ])->orderBy('position')->get();

        return view('products.index', ['categories' => $categories]);
    }

    /**
     * La fiche d'un produit, ou une page 404 si l'id n'existe pas.
     */
    public function show(int $id): View
    {
        $product = Product::findOrFail($id);

        return view('products.show', ['product' => $product]);
    }
}
