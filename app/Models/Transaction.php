<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_category_id', 'user_id', 'description', 'amount', 'type', 'transaction_date'];
    protected $casts = ['amount' => 'decimal:2', 'transaction_date' => 'date'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(TransactionCategory::class, 'transaction_category_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}