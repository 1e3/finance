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

    public function findWhereUser($user_id, $attributes = ['*'])
    {
        return Invoice::join('invoice_user', function ($join) use ($user_id) {
                $join->on('invoices.id', '=', 'invoice_user.invoice_id')
                    ->where('invoice_user.user_id', '=', $user_id);
            })->select($attributes)
            ->get();
    }


}