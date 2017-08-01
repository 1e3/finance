<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $token;
    protected $response;

    public function signIn($data=['email'=>'andre.galdinolima@gmail.com', 'password'=>'test123'])
    {
        $this->response = $this->json('post','api/auth/signin', $data);
        return json_decode($this->response->getContent());
    }

    public function signUp($data=['name'=>'André','email'=>'andre.galdinolima@gmail.com','password'=>'test123','password_confirmation'=>'test123'])
    {
        $this->response = $this->json('post','api/auth/signup', $data);
        return json_decode($this->response->getContent());

    }
}
