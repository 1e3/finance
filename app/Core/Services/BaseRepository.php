<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/20/17
 * Time: 5:39 PM
 */

namespace App\Core\Services;


use App\Core\Contracts\CrudInterface;

abstract class BaseServices implements CrudInterface
{
    public function save($data = array(), $transaction = true)
    {


    }

}