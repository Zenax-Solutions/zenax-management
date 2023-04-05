<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerDetails extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'customer_id',
        'businuss_name',
        'email',
        'number',
        'address',
        'about',
        'qoutation',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'customer_details';

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
