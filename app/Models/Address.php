<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'street_address',
        'city',
        'province',
        'post_code',
        'country',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class); // Alamat dimiliki oleh satu pelanggan
    }
    public function order()
    {
        return $this->belongsTo(Order::class); // Alamat dimiliki oleh satu pesanan
    }
}
