<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/*
| Chaque test de tests/Feature démarre sur une base SQLite en mémoire, migrée
| à neuf (RefreshDatabase) : votre database/database.sqlite n'est jamais touchée.
| withoutVite() : les tests ne regardent pas le CSS, ils tournent sans npm run build.
*/
pest()->extend(TestCase::class)
    ->use(RefreshDatabase::class)
    ->beforeEach(fn () => $this->withoutVite())
    ->in('Feature');
