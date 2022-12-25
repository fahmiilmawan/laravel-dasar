<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Service\HalloService;
use App\Service\HalloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class ServiceContainerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDepedency()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals('Foo',$foo1->foo());// new Foo()
        self::assertEquals('Foo',$foo2->foo());// new Foo()
        self::assertEquals($foo1,$foo2);
    }
//bind membuat objek secara terus menerus
    public function testBind()
    {
        $this->app->bind(Person::class, function($app){
            return new Person("Fahmi","Ilmawan"); //closure()

        });
        $person1 = $this->app->make(Person::class); // closure() //new person("Fahmi","Ilmawan")
        $person2 = $this->app->make(Person::class); // closure() //new person("Fahmi","Ilmawan")

        self::assertEquals("Fahmi", $person1->firstname);
        self::assertEquals("Ilmawan",$person1->lastname);
        self::assertNotSame($person1,$person2);
    }
    // singleton hanya mengambil objek dari class yang sudah ada
    public function testSingleton()
    {
        $this->app->singleton(Person::class, function($app){
            return new Person("Fahmi","Ilmawan"); // objek

        });
        $person1 = $this->app->make(Person::class); // new Person("Fahmi","Ilmawan"); Jika tidak ada
        $person2 = $this->app->make(Person::class); //kembalikan yang sudah ada

        self::assertEquals("Fahmi", $person1->firstname);
        self::assertEquals("Ilmawan",$person1->lastname);
        self::assertSame($person1,$person2);
    }
    // instance menggunakan turunan dari objek yang sudah ada
    public function testInstance()
    {
        $person = new Person("Fahmi","Ilmawan"); //objek
        $this->app->instance(Person::class, $person) //Menggunakan Objek yang sudah ada
        ;
        $person1 = $this->app->make(Person::class); // new Person("Fahmi","Ilmawan") Jika tidak ada
        $person2 = $this->app->make(Person::class); // Kembalikan yang sudah ada

        self::assertEquals("Fahmi", $person1->firstname);
        self::assertEquals("Ilmawan",$person1->lastname);
        self::assertSame($person1,$person2);
    }
    // Memanggil Objek constructor menggunakan singleton
    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function($app){
           return new Foo();
        });
        $this->app->singleton(Bar::class,function ($app){
           return new Bar($app->make(Foo::class));
        });

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($bar1,$bar2);
    }
    //mencoba memanggil interface melalui class
    public function testInterfaceToClass()
    {
        $this->app->singleton(HalloService::class, function($app){
            return new HalloServiceIndonesia();
        });
        $halloService = $this->app->make(HalloService::class);

        self::assertEquals("halo fahmi",$halloService->halo('fahmi'));
    }
}
