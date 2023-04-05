<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacebookAd extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'content',
        'type',
        'status',
        'reach',
        'leads',
        'cost',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'facebook_ads';

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
