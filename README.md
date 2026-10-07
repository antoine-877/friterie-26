# La carte de la Friterie Chez Nadia (friterie-26)

Le dépôt de départ des chapitres 15 et 16 de 5XCOS (bloc Laravel, « Formulaires :
créer et valider » et « Formulaires : modifier et supprimer »). Nadia tient la
carte de sa friterie, à Wavre : les produits par catégorie, leur prix, leurs
allergènes. Le site est une carte, sans compte ni commande en ligne.

Le dépôt fournit la base, les modèles, les données, la mise en forme et les pages
de lecture. **Les routes, les modèles et les vues de lecture sont déjà écrits :
lisez-les, ce sont ceux des chapitres 7 à 12.** Les chapitres 15 et 16 y ajoutent
les formulaires : ajouter un produit, le modifier, cocher ses allergènes, le
marquer en rupture, le retirer de la carte.

Il faut **PHP 8.4 ou plus**, Composer, Node et npm.

## Installer le dépôt

1. **Forkez** ce dépôt sur votre compte GitHub (bouton *Fork* en haut à droite).
2. **Clonez** votre fork, de préférence dans le dossier servi par Herd ou Laragon :
   ```bash
   git clone https://github.com/VOTRE-COMPTE/friterie-26.git
   cd friterie-26
   ```
3. **Installez** les dépendances et préparez le projet :
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate --seed
   npm install
   ```
   `php artisan migrate --seed` vous propose de créer `database/database.sqlite` :
   répondez `yes`. Il y met les quatre catégories, les huit allergènes et les
   seize produits de la carte.
4. **Lancez le site** :
   ```bash
   composer run dev
   ```
   Avec Herd ou Laragon, le site répond sur **http://friterie-26.test** ;
   `composer run dev` reste nécessaire pour le CSS (Vite). Sans Herd ni Laragon,
   il répond sur http://localhost:8000.
5. **Vérifiez** que les tests passent :
   ```bash
   php artisan test
   ```

## Les pages fournies

| Adresse | Nom de la route | Ce qu'elle affiche |
|---|---|---|
| `/` | | redirige vers `/carte` |
| `/carte` | `products.index` | la carte : les catégories dans l'ordre de `position`, leurs produits triés par nom, avec prix, allergènes et badge « En rupture » (`ProductController@index`) |
| `/produits/{id}` | `products.show` | la fiche d'un produit : nom, catégorie (lien), prix, description, allergènes, badge ; 404 si l'id n'existe pas (`ProductController@show`, `findOrFail`) |
| `/categories/{id}` | `categories.show` | une catégorie et ses produits, « Aucun produit » si elle est vide (`CategoryController@show`) |
| `/composants` | `styleguide` | tous les composants du site, dans toutes leurs variantes |

`{id}` est un entier : `whereNumber('id')` dans `routes/web.php`. La Sauce lapin
(`/produits/13`) est en rupture depuis le 3 octobre 2026 à 11 h 30.

## Le schéma

Une catégorie compte plusieurs produits ; un produit contient plusieurs
allergènes, et un allergène se trouve dans plusieurs produits.

- **`categories`** : une catégorie de la carte (`name`) et sa place (`position`, 1 en haut).
- **`products`** : un produit (`name`, 60 caractères), son prix (`price`, décimal 5,2), une `description` facultative, `sold_out_at` (le moment où il a manqué, `null` s'il est disponible) et sa catégorie (`category_id`, supprimé avec elle).
- **`allergens`** : un allergène à déclarer (`name`) : Gluten, Lactose, Œuf, Arachide, Soja, Moutarde, Poisson, Céleri.
- **`allergen_product`** : la table pivot, une ligne par allergène d'un produit ; pas d'`id`, la clé primaire est le couple des deux colonnes.

Les modèles : `Category` (`products()`), `Product` (`category()`, `allergens()`,
`isSoldOut()`, `#[Fillable]`, `price` en `decimal:2`, `sold_out_at` en `datetime`),
`Allergen` (`products()`). Les fabriques `CategoryFactory`, `ProductFactory` (état
`soldOut()`) et `AllergenFactory` servent aux tests.

## Les composants du site

Tous sont montrés sur `/composants`, dans `resources/views/components/`.

| Composant | Rôle |
|---|---|
| `<x-layouts.app title="…">` | le layout : en-tête avec la pastille « CN » et le menu, pied de page avec l'adresse |
| `<x-button>` | un bouton ; prop `variant` : `primary` (par défaut), `secondary`, `danger` ; avec `href`, un lien qui en a l'apparence |
| `<x-badge>` | une pastille ; prop `variant` : `sold-out` (rouge), `allergen` (ambre), `category` (neutre, par défaut) |
| `<x-card>` | une carte, avec un slot facultatif `image` |
| `<x-nav-link>` | un lien du menu ; props `href` et `active` |
| `<x-product-card :product="$product" />` | la carte d'un produit, sur la carte et sur la page d'une catégorie |
| `<x-label for="…">` | le libellé d'un champ |
| `<x-input name="…">` | un champ de saisie ; prop `type` (`text` par défaut) |
| `<x-select name="…">` | une liste déroulante, les `<option>` dans le slot |
| `<x-textarea name="…">` | une zone de texte, le contenu dans le slot |

Les quatre composants de champ sont ceux imaginés à la fin du chapitre 14. Chacun
lit **lui-même `$errors`** : si le serveur a refusé la valeur du champ
(`$errors->has($name)`), la bordure passe en rouge et le champ reçoit
`aria-invalid="true"` et `aria-describedby="{name}-error"`. L'`id` du champ vaut
son `name`, sauf si vous en passez un. Le message, lui, reste écrit dans la vue,
sous le champ :

```html
<x-label for="name">Nom</x-label>
<x-input name="name" :value="old('name')" />
@error('name')
    <p id="name-error" class="mt-2 text-sm text-red-600">{{ $message }}</p>
@enderror
```

La couleur de marque est un **jaune frite** (`brand-50` à `brand-950` dans
`resources/css/app.css`). Le blanc est illisible sur du jaune : les boutons
principaux et la pastille écrivent en noir (`text-zinc-950`) sur `bg-brand-400`,
les liens de couleur prennent `brand-700`.

## Ce que les chapitres 15 et 16 ajoutent

| Chapitre | Verbe | Adresse | Nom | Ce qui s'ajoute |
|---|---|---|---|---|
| 15 | `GET` | `/produits/nouveau` | `products.create` | le formulaire d'ajout |
| 15 | `POST` | `/produits` | `products.store` | `validate()`, `@error`, `old()`, Laravel-Lang en français, le message flash |
| 16 | `GET` | `/produits/{product}/modifier` | `products.edit` | le formulaire pré-rempli |
| 16 | `PUT` | `/produits/{product}` | `products.update` | `@method('PUT')`, la Form Request `ProductRequest`, les allergènes cochés et `sync()` |
| 16 | `POST` | `/categories/{category}/produits` | `categories.products.store` | la création par la relation, `$category->products()->create()` |
| 16 | `PATCH` | `/produits/{product}/rupture` | `products.sold-out` | marquer un produit en rupture |
| 16 | `DELETE` | `/produits/{product}` | `products.destroy` | retirer un produit de la carte, avec confirmation |

Le chapitre 15 passe aussi `APP_LOCALE` à `fr`, affiche le message flash dans le
layout (l'endroit est marqué par un commentaire) et remplace `{id}` par la liaison
de modèle `{product}`. Le chapitre 16 ajoute le lien « Ajouter un produit » au menu.

## Branche et tag

`main` est le point de départ du chapitre 15, marqué par le tag `depart`. Pour
revenir à ce point à tout moment : `git switch -c reprise depart`.
