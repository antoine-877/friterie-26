<x-layouts.app title="La carte">
    <div class="mb-8">
        <h1 class="text-3xl font-semibold tracking-tight">La carte</h1>
        <p class="mt-2 text-zinc-600 dark:text-zinc-400">Les frites, les snacks, les sauces et les boissons de la friterie, avec leurs prix et leurs allergènes.</p>
    </div>

    <div class="space-y-12">
        @foreach ($categories as $category)
            <section aria-labelledby="category-{{ $category->id }}">
                <h2 id="category-{{ $category->id }}" class="mb-4 text-xl font-semibold tracking-tight">
                    <a href="{{ route('categories.show', $category->id) }}" class="rounded-sm hover:underline hover:underline-offset-4 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600">{{ $category->name }}</a>
                </h2>

                @if ($category->products->isEmpty())
                    <p class="text-zinc-600 dark:text-zinc-400">Aucun produit</p>
                @else
                    <ul class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($category->products as $product)
                            <li><x-product-card :product="$product" /></li>
                        @endforeach
                    </ul>
                @endif
            </section>
        @endforeach
    </div>
</x-layouts.app>
