<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/20/17
 * Time: 7:20 PM
 */

namespace App\Applications\Api\Http\Controllers;


use App\Domains\Models\Users\Repositories\UserRepository;

class UserController
{
    private $repo;
    public function __construct(UserRepository $user)
    {
        $this->repo = $user;
    }

    public function index()
    {
        return $this->repo->findAll();
    }
}