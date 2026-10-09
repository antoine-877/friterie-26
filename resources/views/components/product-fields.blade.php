<div>
    @props(['product', 'categories', 'allergens'])

@php
    $checkedAllergens = session()->hasOldInput()
        ? (array) old('allergens', [])
        : $product->allergens->pluck('id')->all();
@endphp

<div>
    <x-label for="name">Nom</x-label>
    <x-input name="name" :value="old('name', $product->name)" />

    @error('name')
        <p id="name-error" class="mt-2 text-sm text-red-600 dark:text-red-400">
            {{ $message }}
        </p>
    @enderror
</div>

<div>
    <x-label for="category_id">Catégorie</x-label>

    <x-select name="category_id">
        <option value="">Choisissez une catégorie</option>

        @foreach ($categories as $category)
            <option
                value="{{ $category->id }}"
                @selected(old('category_id', $product->category_id) == $category->id)
            >
                {{ $category->name }}
            </option>
        @endforeach
    </x-select>

    @error('category_id')
        <p id="category_id-error" class="mt-2 text-sm text-red-600 dark:text-red-400">
            {{ $message }}
        </p>
    @enderror
</div>

<div>
    <x-label for="price">Prix (€)</x-label>
    <x-input
        name="price"
        type="number"
        step="0.10"
        min="0"
        :value="old('price', $product->price)"
    />

    @error('price')
        <p id="price-error" class="mt-2 text-sm text-red-600 dark:text-red-400">
            {{ $message }}
        </p>
    @enderror
</div>

<div>
    <x-label for="description">Description</x-label>

    <x-textarea name="description">{{ old('description', $product->description) }}</x-textarea>

    @error('description')
        <p id="description-error" class="mt-2 text-sm text-red-600 dark:text-red-400">
            {{ $message }}
        </p>
    @enderror
</div>

<fieldset>
    <legend class="text-sm font-medium">Allergènes</legend>

    <div class="mt-2 grid grid-cols-2 gap-2 sm:grid-cols-4">
        @foreach ($allergens as $allergen)
            <label class="flex items-center gap-2 text-sm">
                <input
                    type="checkbox"
                    name="allergens[]"
                    value="{{ $allergen->id }}"
                    @checked(in_array($allergen->id, $checkedAllergens))
                    class="size-4 accent-brand-600"
                >

                {{ $allergen->name }}
            </label>
        @endforeach
    </div>

    @error('allergens.*')
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">
            {{ $message }}
        </p>
    @enderror
</fieldset>
</div>