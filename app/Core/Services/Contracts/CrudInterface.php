<?php
namespace App\Core\Services\Contracts;

interface CrudInterface {

    public function save($data = [],$transaction = true);
    public function update($id, $data = array(), $transaction = true);
    public function delete($id, $transaction = true);
}
