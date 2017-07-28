<?php
namespace App\Domains\Models\Users\Repositories;


use App\Domains\Users\User;
use Rinvex\Repository\Repositories\EloquentRepository;
use Illuminate\Contracts\Container\Container;

class UserRepository extends EloquentRepository
{

    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(User::class)
            ->setRepositoryId('rinvex.repository.users');
    }

}