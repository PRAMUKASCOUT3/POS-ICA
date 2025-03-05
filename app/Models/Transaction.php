<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $primaryKey = 'id_cashier'; // Primary key
    public $incrementing = true; // Auto-increment
    protected $keyType = 'int'; // Tipe data primary key

    protected $fillable = [
        'code',
        'id_user',
        'id_product',
        'date',
        'total_item',
        'subtotal',
        'discount',
        'amount_paid',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user'); // Pastikan foreign key benar
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product'); // Pastikan foreign key benar
    }

    public function expenditure()
    {
        return $this->belongsTo(Expenditure::class, 'id_expenditure', 'id_expenditure'); // Pastikan foreign key benar
    }
    
}
