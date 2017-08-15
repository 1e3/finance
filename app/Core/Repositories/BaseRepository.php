<?php
namespace App\Core\Repositories;

use App\Core\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository implements BaseRepositoryInterface {

    protected $model;
    protected $builder;

    public function newQuery()
    {
        return $this->builder = app($this->model)->newQuery();
    }

    public function doQuery()
    {
        if (!$this->builder)
            $this->newQuery();
        return $this->builder->get();
    }

    public function findById($id)
    {
        if (!$this->builder)
            $this->newQuery();
        return $this->builder->find($id);
    }

    public function beginTransaction()
    {
        DB::beginTransaction();
    }

    public function commit()
    {
        DB::commit();
    }

    public function rollBack()
    {
        DB::rollBack();
    }

    public function create($attributes)
    {
        $model = $this->newQuery()->getModel()->newInstance();
        $model->fill($attributes);
        $created = $model->save();
        return ($created) ? $model : $created ;
    }

    public function update($id, $attributes)
    {
        $updated = false;
        $model = $this->findById($id);
        if ($model){
            $model->fill($attributes);
            $updated = $model->save();
        }
        return ($updated) ? $model : $updated ;
    }

    public function delete($id)
    {
        $deleted = false;
        $model = $this->findById($id);
        if ($model){
            $deleted = $model->delete();
        }
        return ($deleted) ? $model : $deleted ;
    }

    public function getAll()
    {
        return $this->doQuery();
    }
}

