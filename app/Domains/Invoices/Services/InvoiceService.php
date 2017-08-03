<?php
namespace App\Domains\Invoices\Services;

use App\Core\Services\BaseService;
use App\Domains\Invoices\Repositories\InvoiceRepository;

class InvoiceService extends BaseService
{
    public function __construct(InvoiceRepository $repo)
    {
        $this->setRepo($repo);
    }
}