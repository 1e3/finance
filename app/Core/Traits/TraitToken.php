<?php
namespace App\Core\Traits;

use Tymon\JWTAuth\Facades\JWTAuth;

trait TraitToken
{

    protected function generateToken($user)
    {
        return JWTAuth::fromUser($user);
    }

    protected function getTokenLife($token)
    {
        JWTAuth::setToken($token);
        $payload = JWTAuth::decode(JWTAuth::getToken());
        $expires_at = date('d M Y h:i', $payload->get('exp'));
        return $expires_at;
    }

}