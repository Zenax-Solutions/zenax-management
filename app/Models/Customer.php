<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'facebook_ad_id',
        'status',
        'platform',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    public function facebookAd()
    {
        return $this->belongsTo(FacebookAd::class);
    }

    public function allCustomerDetails()
    {
        return $this->hasMany(CustomerDetails::class);
    }

    public function allOrders()
    {
        return $this->hasMany(Orders::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
