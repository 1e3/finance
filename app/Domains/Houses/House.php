<?php

namespace App\Domains\Houses;

use App\Domains\Invoices\Invoice;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = ['name'];
    protected $table = 'houses';

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
