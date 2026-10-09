<x-layouts.app :title="'Modifier ' . $product->name">
    <div class="mx-auto max-w-2xl">
        <h1 class="mb-8 text-3xl font-semibold tracking-tight">
            Modifier {{ $product->name }}
        </h1>

        <form method="POST" action="{{ route('products.update', $product->id) }}"
            class="space-y-6 rounded-xl border border-zinc-200 bg-white p-6 shadow-xs sm:p-8 dark:border-zinc-800 dark:bg-zinc-900">
            @csrf
            @method('PUT')

            <x-product-fields :product="$product" :categories="$categories" :allergens="$allergens" />

            <div class="flex justify-end">
                <x-button type="submit">Enregistrer</x-button>
            </div>
        </form>
    </div>
</x-layouts.app>
