<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
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

        return view('products.create', ['categories' => $categories]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $product = Product::create($request->validated());

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
        ]);
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return redirect()
            ->route('products.show', $product->id)
            ->with('status', 'Le produit a été modifié.');
    }
}
