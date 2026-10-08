<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            'products' => fn($query) => $query->orderBy('name'),
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

    public function create(): View
    {
        $categories = Category::orderBy('position')->get();

        return view('products.create', ['categories' => $categories]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:60'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0.5', 'max:50'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $product = Product::create($request->only(['name', 'category_id', 'price', 'description']));

        return redirect()->route('products.show', $product->id);
    }
}
