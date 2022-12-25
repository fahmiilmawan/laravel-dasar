<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Fahmi Ilmawan');
    }

    public function testNested()
    {
    $this->get('/hello-world')
        ->assertSeeText('World Fahmi Ilmawan');
    }

    public function testTemplate()
    {
        $this->view('hello',['name'=>'Fahmi Ilmawan'])
            ->assertSeeText('Hello Fahmi Ilmawan');

        $this->view('hello.world',['name'=>'Fahmi Ilmawan'])
            ->assertSeeText('World Fahmi Ilmawan');
    }


}
