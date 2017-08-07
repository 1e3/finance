<?php
namespace App\Domains\Invoices\Transformers;

use App\Domains\Invoices\Invoice;
use \League\Fractal\TransformerAbstract;
class InvoiceTransformer extends TransformerAbstract
{
    public function transform(Invoice $invoice)
    {
        $residents = array();
        foreach ($invoice->users as $user){
            $payments = array();
            foreach ($invoice->payments->where('user_id',$user->id) as $pay){
                $payments[] = [
                    'id'    =>  $pay->id,
                    'value' =>  $pay->price,
                    'data'  =>  $pay->paid_at->format('d/m/Y'),
                    'status'=>  $pay->statusString
                ];
            }
            $residents[] = [
                'id'    =>  $user->id,
                'name'    =>  $user->name,
                'value_to_pay'  =>  $user->value_to_pay,
                'total_to_pay'  =>  $user->total_splited,
                'total_paid'    =>  $user->total_paid,
                'payments'     =>  $payments
            ];
        }

        return [
            'id'        => (int) $invoice->id,
            'item'      => $invoice->description,
            'value'     => $invoice->price,
            'data'      => $invoice->bought_at->format('d/m/Y'),
            'parcels'   => $invoice->parcels,
            'value_by_parcel'   =>   $invoice->price_parcel,
            'user_payment'  => [
                'id'    =>  $invoice->userWhoPaid->id,
                'name'  =>  $invoice->userWhoPaid->name
            ],
            'category'  => [
                'id'    =>  $invoice->category->id,
                'name'  =>  $invoice->category->name
            ],
            'residents' =>  $residents
        ];
    }
}