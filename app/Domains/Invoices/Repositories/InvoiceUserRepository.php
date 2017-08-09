<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/21/17
 * Time: 11:44 AM
 */

namespace App\Domains\Invoices\Repositories;

use App\Domains\Invoices\InvoiceUser;
use Illuminate\Container\Container;
use Rinvex\Repository\Repositories\EloquentRepository;

class InvoiceUserRepository extends EloquentRepository
{
    protected $join;
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(InvoiceUser::class)
            ->setRepositoryId('rinvex.repository.invoicesusers');
    }
}