@php
    // Pour montrer l'état d'erreur sans envoyer de formulaire, la page ajoute elle-même
    // trois messages dans $errors, comme le ferait une validation refusée.
    // ($errors->add() ne suffit pas : sans erreur en session, le sac « default » n'existe pas encore.)
    $errors->put('default', new Illuminate\Support\MessageBag([
        'demo_name' => 'Le champ nom est obligatoire.',
        'demo_category_id' => 'Le champ catégorie est obligatoire.',
        'demo_description' => 'Le texte de description ne peut pas contenir plus de 500 caractères.',
    ]));
@endphp

<x-layouts.app title="Composants">
    <div class="mb-8">
        <h1 class="text-3xl font-semibold tracking-tight">Les composants du site</h1>
        <p class="mt-2 text-zinc-600 dark:text-zinc-400">Chaque élément de l'interface, dans toutes ses variantes, sur une seule page.</p>
    </div>

    <div class="space-y-10">
        <section>
            <h2 class="text-xl font-semibold tracking-tight">Boutons</h2>
            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400"><code>&lt;x-button&gt;</code>, prop <code>variant</code> : <code>primary</code> (par défaut, texte noir sur le jaune), <code>secondary</code>, <code>danger</code>. Dans un formulaire : <code>type="submit"</code>. Avec <code>href</code>, le composant écrit un lien <code>&lt;a&gt;</code> qui a l'apparence d'un bouton.</p>
            <p class="mt-4 flex flex-wrap gap-3">
                <x-button>Enregistrer</x-button>
                <x-button variant="secondary">Annuler</x-button>
                <x-button variant="danger">Retirer de la carte</x-button>
                <x-button disabled>Indisponible</x-button>
                <x-button :href="route('products.index')" variant="secondary">Un lien en forme de bouton</x-button>
            </p>
        </section>

        <section>
            <h2 class="text-xl font-semibold tracking-tight">Badges</h2>
            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400"><code>&lt;x-badge&gt;</code>, prop <code>variant</code> : <code>sold-out</code> (un produit en rupture), <code>allergen</code> (un allergène), <code>category</code> (une catégorie, par défaut).</p>
            <p class="mt-4 flex flex-wrap gap-3">
                <x-badge variant="sold-out">En rupture</x-badge>
                <x-badge variant="allergen">Gluten</x-badge>
                <x-badge variant="allergen">Moutarde</x-badge>
                <x-badge variant="category">Snacks</x-badge>
            </p>
        </section>

        <section>
            <h2 class="text-xl font-semibold tracking-tight">Cartes</h2>
            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400"><code>&lt;x-card&gt;</code>, avec un slot facultatif <code>&lt;x-slot:image&gt;</code> au-dessus du contenu. <code>&lt;x-product-card :product="$product" /&gt;</code> est une carte toute faite pour un produit : nom, prix, description, badges.</p>
            <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <x-card>
                    <h3 class="font-semibold">Titre de la carte</h3>
                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">Le contenu de la carte : un texte court, une liste ou une image.</p>
                </x-card>

                <x-card>
                    <x-slot:image>
                        <div class="grid h-32 place-items-center bg-brand-100 text-4xl font-semibold text-brand-800 dark:bg-brand-900 dark:text-brand-100" aria-hidden="true">CN</div>
                    </x-slot:image>

                    <h3 class="font-semibold">Une carte avec image</h3>
                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">L'image passe dans le slot <code>image</code>, le texte dans le contenu.</p>
                </x-card>
            </div>
        </section>

        <section>
            <h2 class="text-xl font-semibold tracking-tight">Lien du menu</h2>
            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400"><code>&lt;x-nav-link&gt;</code>, props <code>href</code> et <code>active</code> : le lien actif est surligné et porte <code>aria-current="page"</code>.</p>
            <ul class="mt-4 flex flex-wrap gap-2">
                <li><x-nav-link :href="route('products.index')" :active="true">Lien actif</x-nav-link></li>
                <li><x-nav-link :href="route('products.index')">Lien inactif</x-nav-link></li>
            </ul>
        </section>

        <section>
            <h2 class="text-xl font-semibold tracking-tight">Champs de formulaire</h2>
            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400"><code>&lt;x-label for="…"&gt;</code>, <code>&lt;x-input name="…"&gt;</code> (prop <code>type</code>, <code>text</code> par défaut), <code>&lt;x-select name="…"&gt;</code> (les <code>&lt;option&gt;</code> dans le slot) et <code>&lt;x-textarea name="…"&gt;</code> (le contenu dans le slot). L'<code>id</code> vaut le <code>name</code>, sauf si vous en passez un. Chaque champ lit lui-même <code>$errors</code> : si le serveur a refusé sa valeur, la bordure passe en rouge et le champ reçoit <code>aria-invalid="true"</code> et <code>aria-describedby="{name}-error"</code>. Le message reste écrit dans la vue, sous le champ : <code>@@error('name') &lt;p id="name-error"&gt;@{{ $message }}&lt;/p&gt; @@enderror</code>.</p>

            <div class="mt-6 grid gap-8 lg:grid-cols-2">
                <x-card>
                    <h3 class="font-semibold">Sans erreur</h3>

                    <div class="mt-4 space-y-5">
                        <div>
                            <x-label for="name">Nom</x-label>
                            <x-input name="name" value="Petite frite" />
                        </div>

                        <div>
                            <x-label for="category_id">Catégorie</x-label>
                            <x-select name="category_id">
                                <option value="1">Frites</option>
                                <option value="2" selected>Snacks</option>
                                <option value="3">Sauces</option>
                                <option value="4">Boissons</option>
                            </x-select>
                        </div>

                        <div>
                            <x-label for="price">Prix (€)</x-label>
                            <x-input name="price" type="number" step="0.10" min="0" value="3.00" />
                        </div>

                        <div>
                            <x-label for="description">Description</x-label>
                            <x-textarea name="description">Un cornet de frites fraîches, coupées le matin.</x-textarea>
                        </div>
                    </div>
                </x-card>

                <x-card>
                    <h3 class="font-semibold">Avec une erreur de validation</h3>

                    <div class="mt-4 space-y-5">
                        <div>
                            <x-label for="demo_name">Nom</x-label>
                            <x-input name="demo_name" />
                            @error('demo_name')
                                <p id="demo_name-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <x-label for="demo_category_id">Catégorie</x-label>
                            <x-select name="demo_category_id">
                                <option value="">Choisissez une catégorie</option>
                                <option value="1">Frites</option>
                                <option value="2">Snacks</option>
                            </x-select>
                            @error('demo_category_id')
                                <p id="demo_category_id-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <x-label for="demo_description">Description</x-label>
                            <x-textarea name="demo_description" rows="2">Une description beaucoup trop longue…</x-textarea>
                            @error('demo_description')
                                <p id="demo_description-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </x-card>
            </div>
        </section>
    </div>
</x-layouts.app>
