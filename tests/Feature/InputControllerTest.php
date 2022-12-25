<?php

namespace Tests\Feature;

use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInputController()
    {
        $this->get('/input/hello?name=Fahmi')
            ->assertSeeText('Hello Fahmi');

        $this->post('/input/hello',['name'=>'Fahmi'])
            ->assertSeeText('Hello Fahmi');
    }
    public function testNestedInput()
    {
        $this->post('/input/hello/first',['name'=>[
            "first" => "Fahmi"
        ]])->assertSeeText("Hello Fahmi");
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input',['name'=>
            [
                "first" => "Fahmi",
                "last"  => "Ilmawan"
            ]])->assertSeeText('name')
            ->assertSeeText("first")
            ->assertSeeText("Fahmi")
            ->assertSeeText("last")
            ->assertSeeText("Ilmawan");
    }

    public function testArray()
    {
        $this->post('/input/hello/array',[
            'products'=>[
            ['name'=>'Apple Macbook'],
            ['name'=>'Samsung Galaxy S']

            ]
        ])->assertSeeText('Apple Macbook')->assertSeeText('Samsung Galaxy S');
    }
    public function testInputType()
    {
        $this->post('/input/type',[
                'name'=>'Fahmi Ilmawan',
                'married'=>'true',
                'birth_date'=>'2002-10-10'


        ])->assertSeeText('Fahmi Ilmawan')->assertSeeText('true')->assertSeeText('2002-10-10');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only',[
            'name'=>
                [
                    'first'=>'Fahmi',
                    'middle'=>'NoMiddle',
                    'last'=>'Ilmawan'
                ]
        ])->assertSeeText('Fahmi')->assertSeeText('Ilmawan')->assertDontSeeText('NoMiddle');
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except',[
              'username' => 'Fahmi Ilmawan',
              'password' => 'rahasia',
              'admin'=>'true'
        ])->assertSeeText('Fahmi Ilmawan')->assertSeeText('rahasia')->assertDontSeeText('true');
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge',[
            'username'=>'Fahmi Ilmawan',
            'password'=>'rahasia',
            'admin'=> 'true'
        ])->assertSeeText('Fahmi Ilmawan')->assertSeeText('rahasia')->assertSeeText('admin')
        ->assertSeeText('false');
    }

}
