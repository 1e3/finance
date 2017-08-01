<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/20/17
 * Time: 5:39 PM
 */

namespace App\Core\Services;


use App\Core\Contracts\CrudInterface;
use Rinvex\Repository\Repositories\EloquentRepository;

abstract class BaseService implements CrudInterface
{
    protected $repo;

    /**
     * @param mixed $repo
     */
    public function setRepo(EloquentRepository $repo)
    {
        $this->repo = $repo;
    }

    public function save($data = [],$transaction = true)
    {
        if ($transaction)
        {
            $this->repo->beginTransaction();
        }

        if ($model = $this->repo->create($data))
        {
            if ($transaction)
                $this->repo->commit();

            return $model;
        }
        if ($transaction)
            $this->repo->rollBack();
        throw new \Exception("error to create model");
    }


    public function update($id, $data = array(), $transaction = true)
    {
        if ($transaction) {
            $this->repo->beginTransaction();
        }

        if ($model = $this->repo->update($id,$data))
        {
            if ($transaction)
                $this->repo->commit();

            return $model;
        }
        if ($transaction)
            $this->repo->rollBack();
        throw new \Exception("error to update model");
    }

    public function delete($id, $transaction = true)
    {
        if ($transaction) {
            $this->repo->beginTransaction();
        }
        if ($model = $this->repo->delete($id)){
            $traits = class_uses($model);
            $usesSoftDeletes = in_array('Illuminate\Database\Eloquent\SoftDeletingTrait', $traits);
            if ($usesSoftDeletes) {
                if(!$model->trashed()){
                    if ($transaction)
                        $this->repo->rollBack();
                    throw new \Exception("error to delete model");
                }
            }

            if ($transaction)
                $this->repo->commit();

            return $model;
        }
        if ($transaction)
            $this->repo->rollBack();
        throw new \Exception("error to delete model");
    }

    public function findBy($attribute, $value, $attributes = ['*'])
    {
        return $this->repo->findBy($attribute,$value,$attributes);
    }

    public function findAll($attributes = ['*'])
    {
        return $this->repo->findAll($attributes);
    }

}