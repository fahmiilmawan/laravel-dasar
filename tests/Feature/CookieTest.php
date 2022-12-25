<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateCookie()
    {
       $this->get('/cookie/set')
           ->assertCookie('User-Id','Fahmi')
           ->assertCookie('Is-Member','true');
    }

    public function testGetCookie()
    {
        $this->withCookie('User-Id','Fahmi')
            ->withCookie('Is-Member','true')
            ->get('/cookie/get')
            ->assertJson([
                'User-Id'=>'Fahmi',
                'Is-Member'=>'true'
            ]);
    }




}
