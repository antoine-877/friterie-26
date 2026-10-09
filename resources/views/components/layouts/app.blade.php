@props(['title' => 'La carte'])

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} · Friterie Chez Nadia</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="flex min-h-screen flex-col bg-zinc-50 font-sans text-zinc-900 antialiased dark:bg-zinc-950 dark:text-zinc-100">
    <header class="border-b border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
        <div
            class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-x-6 gap-y-2 px-4 py-3 sm:px-6 lg:px-8">
            <a href="{{ route('products.index') }}"
                class="flex items-center gap-2 rounded-md text-lg font-semibold tracking-tight focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand-600">
                <span class="grid size-8 place-items-center rounded-lg bg-brand-400 text-sm font-semibold text-zinc-950"
                    aria-hidden="true">CN</span>
                Friterie Chez Nadia
            </a>

            <button type="button" id="menu-button"
                class="group rounded-md p-2 text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 focus-visible:outline-2 focus-visible:outline-brand-600 md:hidden dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white"
                aria-controls="main-menu" aria-expanded="false">
                <span class="sr-only">Menu</span>
                <svg class="size-6 group-aria-expanded:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg class="hidden size-6 group-aria-expanded:block" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <path d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>

            <nav id="main-menu" class="hidden w-full md:block md:w-auto" aria-label="Navigation principale">

                <ul
                    class="flex flex-col gap-1 border-t border-zinc-200 py-2 md:flex-row md:items-center md:border-0 md:py-0 dark:border-zinc-800">
                    <li>
                        <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index', 'products.show', 'categories.show')">
                            La carte
                        </x-nav-link>
                    </li>

                    <li>
                        <x-nav-link :href="route('products.create')" :active="request()->routeIs('products.create')">
                            Ajouter un produit
                        </x-nav-link>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="mx-auto w-full max-w-6xl flex-1 px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
        @session('status')
            <p role="status"
                class="mb-8 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800 dark:border-green-900 dark:bg-green-950 dark:text-green-200">
                {{ $value }}
            </p>
        @endsession
        {{ $slot }}
    </main>

    <footer class="border-t border-zinc-200 dark:border-zinc-800">
        <div
            class="mx-auto flex max-w-6xl flex-col gap-2 px-4 py-6 text-sm text-zinc-500 sm:flex-row sm:justify-between sm:px-6 lg:px-8 dark:text-zinc-400">
            <p>Friterie Chez Nadia, place de l'Hôtel de Ville 4, 1300 Wavre. Ouverte du mardi au dimanche, de 11 h 30 à
                22 h.</p>
            <p><a href="{{ route('styleguide') }}"
                    class="underline underline-offset-4 hover:text-zinc-900 dark:hover:text-white">Les composants du
                    site</a></p>
        </div>
    </footer>
</body>

</html>
