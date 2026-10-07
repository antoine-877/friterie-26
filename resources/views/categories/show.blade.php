<x-layouts.app :title="$category->name">
    <p class="mb-6">
        <a href="{{ route('products.index') }}" class="rounded-sm text-sm font-medium text-brand-700 hover:underline hover:underline-offset-4 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600 dark:text-brand-300">← Retour à la carte</a>
    </p>

    <div class="mb-8">
        <p class="text-sm font-semibold tracking-wide text-brand-700 uppercase dark:text-brand-300">Catégorie</p>
        <h1 class="mt-1 text-3xl font-semibold tracking-tight">{{ $category->name }}</h1>
    </div>

    @if ($products->isEmpty())
        <p class="text-zinc-600 dark:text-zinc-400">Aucun produit</p>
    @else
        <ul class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <li><x-product-card :product="$product" /></li>
            @endforeach
        </ul>
    @endif
</x-layouts.app>
