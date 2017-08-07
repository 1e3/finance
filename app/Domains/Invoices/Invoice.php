<?php

namespace App\Domains\Invoices;

use App\Domains\Categories\Category;
use App\Domains\Houses\House;
use App\Domains\Payments\Payment;
use App\Domains\Users\User;
use App\Domains\Users\UserInvoice;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'price','parcels','bought_at',
        'description','house_id','user_id',
        'user_payment_id','category_id'
    ];

    protected $dates = ['bought_at'];

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

    public function users()
    {
        return $this->belongsToMany(User::class, null, 'invoice_id', 'user_id')->using(InvoiceUser::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    ##

    public function setPriceSplitedAttribute($value)
    {
        $this->attributes['price_splited'] = $value;
    }

    public function setTotalPaidAttribute($value)
    {
        $this->attributes['total_paid'] = $value;
    }

    public function setPriceParcelAttribute($value)
    {
        $this->attributes['price_parcel'] = $value;
    }

    public function setTotalSplitedAttribute($value)
    {
        $this->attributes['total_splited'] = $value;
    }

    public function getSubtotalAttribute()
    {
        return $this->attributes['total_splited'] - $this->attributes['total_paid'];
    }

    public function getNumberResidentsAttribute()
    {
        return $this->users->count();
    }



}
