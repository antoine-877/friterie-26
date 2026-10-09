<x-layouts.app :title="$category->name">
    <p class="mb-6">
        <a href="{{ route('products.index') }}"
            class="rounded-sm text-sm font-medium text-brand-700 hover:underline hover:underline-offset-4 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600 dark:text-brand-300">←
            Retour à la carte</a>
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

    <form method="POST" action="{{ route('categories.products.store', $category->id) }}"
        class="mt-12 max-w-2xl space-y-6 rounded-xl border border-zinc-200 bg-white p-6 shadow-xs sm:p-8 dark:border-zinc-800 dark:bg-zinc-900">
        @csrf

        <h2 class="text-xl font-semibold tracking-tight">Ajouter un produit dans cette catégorie</h2>

        <div>
            <x-label for="name">Nom</x-label>
            <x-input name="name" :value="old('name')" />
            @error('name')
                <p id="name-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-label for="price">Prix (€)</x-label>
            <x-input name="price" type="number" step="0.10" min="0" :value="old('price')" />
            @error('price')
                <p id="price-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <x-button type="submit">Ajouter à {{ $category->name }}</x-button>
        </div>
    </form>

</x-layouts.app>
