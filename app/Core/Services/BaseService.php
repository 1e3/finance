<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/20/17
 * Time: 5:39 PM
 */

namespace App\Core\Services;

use App\Core\Services\Contracts\CrudInterface;
use App\Core\Repositories\BaseRepository;

abstract class BaseService implements CrudInterface
{
    protected $repo;

    /**
     * @param mixed $repo
     */
    public function setRepo(BaseRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param array $data
     * @param bool $transaction
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
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


    /**
     * @param $id
     * @param array $data
     * @param bool $transaction
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
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

    /**
     * @param $id
     * @param bool $transaction
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
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

}