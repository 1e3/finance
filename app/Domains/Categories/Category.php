<?php

namespace App\Domains\Categories;

use App\Domains\Invoices\Invoice;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];
    protected $table = 'categories';

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
