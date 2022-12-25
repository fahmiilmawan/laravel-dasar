<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSessionController()
    {
       $this->get('/create/session')
           ->assertSeeText('OK')
           ->assertSessionHas('UserId','Fahmi')
           ->assertSessionHas('IsMember',true);
    }

    public function testSessionGet()
    {
        $this->withSession([
            'UserId' => 'Fahmi',
            'IsMember' => true
        ])->get('/session/get')
            ->assertSeeText('Fahmi')->assertSeeText(true);

        $this->withSession([])->get('/session/get')
            ->assertSeeText('guest')->assertSeeText(false);
    }


}
