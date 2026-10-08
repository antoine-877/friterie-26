<x-layouts.app :title="$product->name">
    <p class="mb-6">
        <a href="{{ route('products.index') }}"
            class="rounded-sm text-sm font-medium text-brand-700 hover:underline hover:underline-offset-4 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600 dark:text-brand-300">←
            Retour à la carte</a>
    </p>

    <article class="max-w-2xl">
        <p class="flex flex-wrap items-center gap-2">
            <a href="{{ route('categories.show', $product->category->id) }}"
                class="rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600">
                <x-badge variant="category">{{ $product->category->name }}</x-badge>
            </a>
            @if ($product->isSoldOut())
                <x-badge variant="sold-out">En rupture</x-badge>
            @endif
        </p>

        <h1 class="mt-2 text-3xl font-semibold tracking-tight">{{ $product->name }}</h1>

        <p class="mt-2 text-2xl font-semibold tabular-nums">{{ number_format($product->price, 2, ',', ' ') }} €</p>

        @if ($product->description !== null)
            <p class="mt-4 leading-relaxed text-zinc-700 dark:text-zinc-300">{{ $product->description }}</p>
        @endif

        <dl class="mt-6 grid gap-4 border-t border-zinc-200 pt-6 sm:grid-cols-2 dark:border-zinc-800">
            <div>
                <dt class="text-sm text-zinc-500 dark:text-zinc-400">Catégorie</dt>
                <dd class="mt-1 font-semibold">
                    <a href="{{ route('categories.show', $product->category->id) }}"
                        class="hover:underline hover:underline-offset-4">{{ $product->category->name }}</a>
                </dd>
            </div>
            @if ($product->isSoldOut())
                <div>
                    <dt class="text-sm text-zinc-500 dark:text-zinc-400">En rupture depuis</dt>
                    <dd class="mt-1 font-semibold">{{ $product->sold_out_at->format('d/m/Y, H \h i') }}</dd>
                </div>
            @endif
        </dl>

        <div class="mt-6 border-t border-zinc-200 pt-6 dark:border-zinc-800">
            <h2 class="text-sm text-zinc-500 dark:text-zinc-400">Allergènes</h2>
            @if ($product->allergens->isEmpty())
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">Aucun allergène déclaré.</p>
            @else
                <ul class="mt-2 flex flex-wrap gap-2">
                    @foreach ($product->allergens as $allergen)
                        <li><x-badge variant="allergen">{{ $allergen->name }}</x-badge></li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="mt-8 flex flex-wrap gap-3 border-t border-zinc-200 pt-6 dark:border-zinc-800">
            <x-button variant="secondary" :href="route('products.edit', $product->id)">
                Modifier
            </x-button>
        </div>
    </article>
</x-layouts.app>
