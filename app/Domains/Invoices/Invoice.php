<?php

namespace App\Domains\Invoices;

use App\Domains\Categories\Category;
use App\Domains\Houses\House;
use App\Domains\Users\User;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'price','parcels','bought_at',
        'description','house_id','user_id',
        'user_payment_id','category_id'
    ];

    protected $dates = ['bought'];

    public function userCreator()
    {
        return $this->belongsTo(User::class);
    }

    public function userWhoPaid()
    {
        return $this->belongsTo(User::class,'user_payment_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
