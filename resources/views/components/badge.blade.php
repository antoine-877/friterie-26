@props(['variant' => 'category'])

<span @class([
    'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium whitespace-nowrap ring-1 ring-inset',
    'bg-red-50 text-red-700 ring-red-600/20 dark:bg-red-400/10 dark:text-red-300 dark:ring-red-400/30' => $variant === 'sold-out',
    'bg-amber-50 text-amber-800 ring-amber-600/30 dark:bg-amber-400/10 dark:text-amber-200 dark:ring-amber-400/30' => $variant === 'allergen',
    'bg-zinc-100 text-zinc-700 ring-zinc-500/20 dark:bg-zinc-400/10 dark:text-zinc-300 dark:ring-zinc-400/30' => $variant === 'category',
])>
    {{ $slot }}
</span>
