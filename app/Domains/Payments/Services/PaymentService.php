<?php
namespace App\Domains\Payments\Services;

use App\Core\Services\BaseService;
use App\Domains\Payments\Repositories\PaymentRepository;
use Carbon\Carbon;

class PaymentService extends BaseService
{
    /**
     * PaymentService constructor.
     * @param PaymentRepository $repo
     */
    public function __construct(PaymentRepository $repo)
    {
        $this->setRepo($repo);
    }

    public function save($data = [], $transaction = true)
    {
        if ($transaction)
        {
            $this->repo->beginTransaction();
        }
        $data['paid_at'] = (array_key_exists('paid_at',$data))
            ? Carbon::parse($data['paid_at'])
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