<x-layouts.app title="Ajouter un produit"> <div class="mx-auto max-w-2xl"> <h1 class="mb-8 text-3xl font-semibold tracking-tight">Ajouter un produit</h1>

    <form method="POST" action="{{ route('products.store') }}" class="space-y-6 rounded-xl border border-zinc-200 bg-white p-6 shadow-xs sm:p-8 dark:border-zinc-800 dark:bg-zinc-900">
        @csrf

        <div>
            <x-label for="name">Nom</x-label>
            <x-input name="name" :value="old('name')" />

            @error('name')
                <p id="name-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-label for="category_id">Catégorie</x-label>

            <x-select name="category_id">
                <option value="">Choisissez une catégorie</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </x-select>

            @error('category_id')
                <p id="category_id-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-label for="price">Prix (€)</x-label>
            <x-input name="price" type="number" step="0.10" min="0" :value="old('price')" />

            @error('price')
                <p id="price-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-label for="description">Description</x-label>
            <x-textarea name="description">{{ old('description') }}</x-textarea>

            @error('description')
                <p id="description-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <x-button type="submit">Ajouter le produit</x-button>
        </div>
    </form>
</div>


</x-layouts.app>
