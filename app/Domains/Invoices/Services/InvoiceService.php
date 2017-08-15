<?php
namespace App\Domains\Invoices\Services;

use App\Core\Services\BaseService;
use App\Domains\Houses\Services\HouseService;
use App\Domains\Invoices\Repositories\InvoiceRepository;
use Carbon\Carbon;

class InvoiceService extends BaseService
{
    /**
     * InvoiceService constructor.
     * @param InvoiceRepository $repo
     */
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

    /**
     * @param $id
     * @return array
     */
    public function resume($id)
    {
        $invoice = $this->repo->with(['users','userWhoPaid','category','payments'])->find($id);
        $invoice->price_parcel = $this->splitParcels($invoice->price, $invoice->parcels);
        $invoice->total_splited = $this->splitPrice($invoice->price, $invoice->number_residents);
        $invoice->price_splited = $this->splitByUsers($invoice->price, $invoice->parcels, $invoice->number_residents);

        $users = $invoice->users->each(function($user, $key) use ($invoice){
            foreach ($invoice->payments->where('user_id',$user->id) as $pay){
                $user->total_paid += ($pay->status == 1) ? $pay->price : 0;
                $user->value_to_pay = $invoice->price_splited;
                $user->total_splited = $invoice->total_splited;
            }
            return $user;
        });
        $invoice->users = $users;
        $invoice->total_paid = $invoice->users->sum('total_paid');

        return $invoice;
    }

    public function splitByUsers($price,$parcels=1,$countUsers)
    {
        return $this->splitParcels($price,$parcels)/$countUsers;
    }

    public function splitParcels($price,$parcels=1)
    {
        return $price/$parcels;
    }

    public function splitPrice($price,$countUsers)
    {
        return $price/$countUsers;
    }

}