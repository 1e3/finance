<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/20/17
 * Time: 5:39 PM
 */

namespace App\Core\Services;


use App\Core\Contracts\CrudInterface;
use Rinvex\Repository\Contracts\RepositoryContract;

abstract class BaseService #implements CrudInterface
{
    protected $repo;

    public function __construct(RepositoryContractract $repo)
    {
        $this->repo = $repo;
    }

//    public function save($data = array(), $transaction = true)
//    {
//
//
//    }

}