<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testConfig()
    {
        $config = $this->app->make('config');
        $firstname2 = $config->get('contoh.author.first');
        $firstname = config("contoh.author.first");
        $lastname  = Config::get('contoh.author.first');

        self::assertEquals($firstname2,$lastname);
    }

    public function testFacadeMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('Fahmi Keren');
        $firstname = Config::get('contoh.author.first');

        self::assertEquals($firstname, 'Fahmi Keren');
    }

}
