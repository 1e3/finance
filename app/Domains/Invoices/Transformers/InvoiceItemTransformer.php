<?php
/**
 * Created by PhpStorm.
 * User: galdino
 * Date: 8/8/17
 * Time: 7:57 PM
 */

namespace App\Domains\Invoices\Transformers;

use App\Domains\Invoices\Invoice;
use League\Fractal\TransformerAbstract;

class InvoiceItemTransformer extends TransformerAbstract
{
    public function transform(Invoice $invoice)
    {
        return [
            'id'    =>  (int) $invoice->id,
            'description'   =>  str_limit($invoice->description, 100),
            'data'          =>  $invoice->bought_at->timestamp,
            'value'         =>  (float) sprintf("%.2f",$invoice->price*1.0)
        ];
    }
}