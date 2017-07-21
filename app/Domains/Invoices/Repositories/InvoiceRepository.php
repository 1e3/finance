<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/21/17
 * Time: 11:44 AM
 */

namespace App\Domains\Invoices\Repositories;


use App\Domains\Invoices\Invoice;
use Illuminate\Container\Container;
use Rinvex\Repository\Repositories\EloquentRepository;

class InvoiceRepository extends EloquentRepository
{
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(Invoice::class)
            ->setRepositoryId('rinvex.repository.invoices');
    }
}