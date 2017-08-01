<?php
namespace App\Core\Contracts;

use phpDocumentor\Reflection\Types\Integer;

interface CrudInterface {

    public function save($data = [],$transaction = true);
    public function update($id, $data = array(), $transaction = true);
    public function delete($id, $transaction = true);
}
