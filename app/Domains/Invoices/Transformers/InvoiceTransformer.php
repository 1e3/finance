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
                    'value' => (float) sprintf("%.2f",$pay->price*1.0),
                    'data'  =>  $pay->paid_at->timestamp,
                    'status'=>  $pay->statusString
                ];
            }
            $residents[] = [
                'id'    =>  $user->id,
                'name'    =>  $user->name,
                'value_to_pay'  =>  (float) sprintf("%.2f",$user->value_to_pay*1.0),
                'total_to_pay'  =>  (float) sprintf("%.2f",$user->total_splited*1.0),
                'total_paid'    =>  (float) sprintf("%.2f",$user->total_paid*1.0),
                'payments'     =>  $payments
            ];
        }

        return [
            'id'        => (int) $invoice->id,
            'item'      => $invoice->description,
            'value'     => (float) sprintf("%.2f",$invoice->price*1.0),
            'data'      => $invoice->bought_at->timestamp,
            'parcels'   => $invoice->parcels,
            'value_by_parcel'   =>  (float) sprintf("%.2f",$invoice->price_parcel*1.0),
            'total_paid'   =>  (float) sprintf("%.2f",$invoice->total_paid*1.0),
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