<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions,DatabaseMigrations;

    public function testRegister()
    {
        $content = $this->signUp();
        $this->assertObjectHasAttribute('access_token', $content);
        $this->token = $content->access_token;
        $this->assertEquals(200,$this->response->status());
    }

    public function testRegisterHasToken()
    {
        $this->signUp();

        $this->assertEquals(200,$this->response->status());
    }

    public function testLogin()
    {
        $this->signUp();
        $this->signIn();
        $this->assertEquals(200,$this->response->status());
    }

    public function testLoginHasToken()
    {
        $this->signUp();
        $content = $this->signIn();
        $this->assertObjectHasAttribute('access_token', $content);
        $this->token = $content->access_token;
        $this->assertEquals(200,$this->response->status());
    }
}
