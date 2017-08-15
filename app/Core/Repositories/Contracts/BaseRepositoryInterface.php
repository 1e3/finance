<?php
namespace App\Core\Repositories\Contracts;

interface BaseRepositoryInterface{

    public function doQuery();
    public function newQuery();
    public function findById($id);
    public function create($attributes);
    public function update($id,$attributes);
    public function delete($id);
    public function beginTransaction();
    public function commit();
    public function rollback();

}