<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankAccount extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'user_id',
        'account_name',
        'account_number',
        'amount',
        'withdrawal',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'bank_accounts';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
