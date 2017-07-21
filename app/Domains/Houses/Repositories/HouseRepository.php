<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/21/17
 * Time: 11:42 AM
 */

namespace App\Domains\Houses\Repositories;


use App\Domains\Houses\House;
use Illuminate\Container\Container;
use Rinvex\Repository\Repositories\EloquentRepository;

class HouseRepository extends EloquentRepository
{
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(House::class)
            ->setRepositoryId('rinvex.repository.houses');
    }
}