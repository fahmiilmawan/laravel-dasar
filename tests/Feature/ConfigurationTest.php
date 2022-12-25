<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testConfiguration()
    {
        $first_name = config('contoh.nama.first_name');
        $last_name = config('contoh.nama.last_name');
        $email = config('contoh.email');
        $web = config('contoh.web');

        self::assertEquals('Fahmi',$first_name);
        self::assertEquals('Ilmawan',$last_name);
        self::assertEquals('fahmikeilmawan22@gmail.com',$email);
        self::assertEquals('https://fahmikeilmawan.com',$web);
    }
}
