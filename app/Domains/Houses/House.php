<?php

namespace App\Domains\Houses;

use App\Domains\Invoices\Invoice;
use App\Domains\Users\User;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = ['name'];
    protected $table = 'houses';

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function residents()
    {
        return $this->belongsToMany(User::class,'user_house','house_id', 'user_id');
    }
}
