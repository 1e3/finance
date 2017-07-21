<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/21/17
 * Time: 11:46 AM
 */

namespace App\Domains\Payments\Repositories;


use App\Domains\Payments\Payment;
use Illuminate\Container\Container;
use Rinvex\Repository\Repositories\EloquentRepository;

class PaymentRepository extends EloquentRepository
{
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(Payment::class)
            ->setRepositoryId('rinvex.repository.payments');
    }
}