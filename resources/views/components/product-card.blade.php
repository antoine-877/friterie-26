{{-- Un produit de la carte : nom (lien vers la fiche), prix, allergènes, badge « En rupture ».
     Reçoit $product, avec ses allergènes déjà chargés par le contrôleur (with). --}}
@props(['product'])

<x-card {{ $attributes->class(['h-full']) }}>
    <div class="flex items-start justify-between gap-4">
        <h3 class="font-semibold">
            <a href="{{ route('products.show', $product->id) }}" class="rounded-sm hover:underline hover:underline-offset-4 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600">{{ $product->name }}</a>
        </h3>
        <p class="font-semibold whitespace-nowrap tabular-nums">{{ number_format($product->price, 2, ',', ' ') }} €</p>
    </div>

    @if ($product->description !== null)
        <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">{{ $product->description }}</p>
    @endif

    @if ($product->isSoldOut() || $product->allergens->isNotEmpty())
        <ul class="mt-3 flex flex-wrap gap-2">
            @if ($product->isSoldOut())
                <li><x-badge variant="sold-out">En rupture</x-badge></li>
            @endif
            @foreach ($product->allergens as $allergen)
                <li><x-badge variant="allergen">{{ $allergen->name }}</x-badge></li>
            @endforeach
        </ul>
    @endif
</x-card>
