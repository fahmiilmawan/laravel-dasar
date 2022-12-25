<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRedirectController()
    {
        $this->get('/redirect/from')
            ->assertRedirect('/redirect/to');
    }
    public function testRedirectName()
    {
        $this->get('/redirect/name')
            ->assertRedirect('/redirect/name/Fahmi');
    }
    public function testRedirectAction()
    {
        $this->get('/redirect/action/')
            ->assertRedirect('/redirect/name/Fahmi');
    }

    public function testRedirectAway()
    {
        $this->get('/redirect/away')
            ->assertRedirect('https://e-learning.smktarpan1.sch.id');
    }

    public function testRedirectNamed()
    {
        $this->get('/redirect/named')
            ->assertSeeText('/redirect/name/Fahmi');
    }


}
