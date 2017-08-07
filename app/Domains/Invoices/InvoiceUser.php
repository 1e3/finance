<?php
namespace App\Domains\Invoices;


use Illuminate\Database\Eloquent\Relations\Pivot;

class InvoiceUser extends Pivot
{
    protected $table = 'user_invoice';

    public function setTotalPaidAttribute($value)
    {
        $this->attributes['total_paid']=$value;
    }

    public function setValueToPayAttribute($value)
    {
        $this->attributes['value_to_pay']=$value;
    }

    public function setTotalSplitedAttribute($value)
    {
        $this->attributes['total_splited'] = $value;
    }
}