<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
       $encrypt = Crypt::encrypt('Si Bonang');
       $decrypt = Crypt::decrypt($encrypt);

       self::assertEquals('Si Bonang', $decrypt);
    }
}
