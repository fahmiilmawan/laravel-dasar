<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testController()
    {
        $this->get('/controller/hello/fahmi')
            ->assertSeeText("Hello fahmi");
    }

    public function testRequest()
    {
        $this->get('controller/hello/request',[
            'Accept' => "plain/text"
        ])
        ->assertSeeText("controller/hello/request")
        ->assertSeeText("http://localhost/controller/hello/request")
        ->assertSeeText("GET")
            ->assertSeeText("plain/text");

    }


}
