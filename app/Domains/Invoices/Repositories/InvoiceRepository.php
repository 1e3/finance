<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 7/21/17
 * Time: 11:44 AM
 */

namespace App\Domains\Invoices\Repositories;

use App\Core\Repositories\BaseRepository;
use App\Domains\Invoices\Invoice;

class InvoiceRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = Invoice::class;
    }

    public function whereUserHasInvoices($user_id)
    {
        $this->newQuery()
            ->join('invoice_user', 'invoices.id', '=', 'invoice_user.invoice_id')
            ->where('invoice_user.user_id', '=', $user_id);

        return $this->doQuery();
    }

    public function whereHouse($house_id)
    {
        $this->newQuery()
            ->where('house_id', '=', $house_id);

        return $this->doQuery();
    }

    public function whereUser($user_id)
    {
        $this->newQuery()
            ->where('user_id','=',$user_id);

        return $this->doQuery();
    }



}