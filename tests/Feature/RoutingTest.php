<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRouting()
    {
      $this -> get('/pzn')
          ->assertStatus(200)
          ->assertSeeText('Hallo Programmer');
    }
    public function testRedirect()
    {
        $this -> get('/youtube')
            ->assertRedirect('/pzn');
    }

    public function testFallback()
    {
        $this -> get('/tidakada')
            ->assertSeeText('404');
    }

    public function testRouteParameter()
    {
        $this->get('/product/1')
            ->assertSeeText('product 1');
    }

    public function testParameterRegex()
    {
        $this->get('/product/100/item/100')
            ->assertSeeText('product 100 dan item 100');
    }

    public function testOptionalRoute()
    {
        $this->get('/user/fahmi')
            ->assertSeeText('user fahmi');
    }

    public function testNamedRoute()
    {
        $this->get("/produk/12345")
            ->assertSeeText("Link http://localhost/product/12345");

        $this->get("/produk-redirect/12345")
            ->assertSeeText('/product/12345');

    }

}
