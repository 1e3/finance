<?php
namespace App\Domains\Invoices\Services;

use App\Core\Services\BaseService;
use App\Domains\Invoices\Repositories\InvoiceRepository;
use Carbon\Carbon;

class InvoiceService extends BaseService
{
    public function __construct(InvoiceRepository $repo)
    {
        $this->setRepo($repo);
    }

    public function save($data = [], $transaction = true)
    {
        if ($transaction)
        {
            $this->repo->beginTransaction();
        }
        $data['bought_at'] = (array_key_exists('bought_at',$data))
            ? Carbon::parse($data['bought_at'])
            : Carbon::today();

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
}