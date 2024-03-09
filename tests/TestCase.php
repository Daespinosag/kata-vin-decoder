<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        // Ejecuta las migraciones para la base de datos de pruebas
        Artisan::call('migrate');
    }

    public function tearDown(): void
    {
        // Revertir las migraciones después de cada prueba
        Artisan::call('migrate:rollback');

        parent::tearDown();
    }

}
