<?php

/*
| Un test de fumée : les pages de lecture fournies répondent, avec les données du seeder.
| Les chapitres 15 et 16 ajoutent les formulaires ; ce fichier doit rester vert.
*/

beforeEach(fn () => $this->seed());

test('la carte répond et affiche les catégories et les produits', function (): void {
    $this->get('/carte')
        ->assertOk()
        ->assertSee('Frites')
        ->assertSee('Petite frite')
        ->assertSee('3,00 €');
});

test('la racine redirige vers la carte', function (): void {
    $this->get('/')->assertRedirect('/carte');
});

test('la fiche d\'un produit répond', function (): void {
    $this->get('/produits/1')
        ->assertOk()
        ->assertSee('Petite frite');
});

test('la fiche d\'un produit en rupture affiche le badge', function (): void {
    $this->get('/produits/13')
        ->assertOk()
        ->assertSee('Sauce lapin')
        ->assertSee('En rupture');
});

test('la fiche d\'un produit inconnu répond 404', function (): void {
    $this->get('/produits/999')->assertNotFound();
});

test('la page d\'une catégorie répond', function (): void {
    $this->get('/categories/1')
        ->assertOk()
        ->assertSee('Grande frite');
});

test('la page des composants répond', function (): void {
    $this->get('/composants')->assertOk();
});
