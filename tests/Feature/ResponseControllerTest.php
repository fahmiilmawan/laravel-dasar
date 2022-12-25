<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testResponse()
    {
        $this->get('/hello/response')
        ->assertStatus(200)
            ->assertSeeText('Hello Response');

    }

    public function testResponseHeader()
    {
        $this->get('/hello/response/header')
            ->assertStatus(200)
            ->assertSeeText('Fahmi')
            ->assertSeeText('Ilmawan')
            ->assertHeader('Content-Type','application/json')
            ->assertHeader('App','Ponggawa Liwa')
            ->assertHeader('Author','Relawan Liwa');
    }

    public function testResponseView()
    {
        $this->get('/type/response/view')
            ->assertSeeText('Hello Fahmi');
    }
    public function testResponseJson()
    {
        $this->get('/type/response/json')
            ->assertStatus(200)
            ->assertJson([
                'firstName' => 'Fahmi',
                'lastName' => 'Ilmawan'
            ]);
    }
    public function testResponseFile()
    {
        $this->get('/type/response/file')
            ->assertHeader('Content-Type','image/png');
    }
    public function testResponseDownload()
    {
        $this->get('/type/response/download')
            ->assertDownload('fahmi.png');
    }


}
