<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions,DatabaseMigrations;

    protected $token;

    public function signIn($data=['email'=>'andre.galdinolima@gmail.com', 'password'=>'test123'])
    {
        $this->post('api/auth/signin', $data);
        $content = json_decode($this->response->getContent());

        $this->assertObjectHasAttribute('token', $content, 'Token does not exists');
        $this->token = $content->token;

        return $this;
    }

    public function testRegister()
    {
        $user = [
            'name'=>'André',
            'email'=>'andregaldinolima@gmail.com',
            'password'=>'test123',
            'password_confirmation'=>'test123'
        ];
        $response = $this->call('GET','api/auth/singup',$user);
        $data = $response->getData(TRUE);

        $this->assertEquals(\HttpResponse::HTTP_OK,$response->status());

    }
}
