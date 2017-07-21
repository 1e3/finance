<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/21/17
 * Time: 11:40 AM
 */

namespace App\Domains\Categories\Repositories;


use App\Domains\Categories\Category;
use Illuminate\Container\Container;
use Rinvex\Repository\Repositories\EloquentRepository;

class CategoryRepository extends EloquentRepository
{
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(Category::class)
            ->setRepositoryId('rinvex.repository.categories');
    }
}