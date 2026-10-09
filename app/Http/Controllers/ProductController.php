<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Allergen;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $categories = Category::with([
            'products' => fn($query) => $query->orderBy('name'),
            'products.allergens',
        ])->orderBy('position')->get();

        return view('products.index', ['categories' => $categories]);
    }

    public function show(Product $product): View
    {
        return view('products.show', ['product' => $product]);
    }

    public function create(): View
    {
        $categories = Category::orderBy('position')->get();

        return view('products.create', [
            'product' => new Product,
            'categories' => $categories,
            'allergens' => Allergen::all(),
        ]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $product = Product::create($validated);

        $product->allergens()->sync($validated['allergens'] ?? []);

        return redirect()
            ->route('products.show', $product->id)
            ->with('status', 'Le produit a été ajouté.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::orderBy('position')->get();

        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
            'allergens' => Allergen::all(),
        ]);
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $validated = $request->validated();

        $product->update($validated);

        $product->allergens()->sync($validated['allergens'] ?? []);

        return redirect()
            ->route('products.show', $product->id)
            ->with('status', 'Le produit a été modifié.');
    }

    public function soldOut(Product $product): RedirectResponse
    {
        if (! $product->isSoldOut()) {
            $product->update(['sold_out_at' => now()]);
        }

        return redirect()
            ->route('products.show', $product->id)
            ->with('status', 'Le produit est marqué en rupture.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('status', 'Le produit a été retiré de la carte.');
    }
}
