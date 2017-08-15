<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/21/17
 * Time: 11:46 AM
 */

namespace App\Domains\Payments\Repositories;


use App\Core\Repositories\BaseRepository;
use App\Domains\Payments\Payment;

class PaymentRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = Payment::class;
    }
}