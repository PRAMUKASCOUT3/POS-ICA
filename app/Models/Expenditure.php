<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expenditure extends Model
{
    use HasFactory;
    protected $table = 'expenditures';
    protected $primaryKey = 'id_expenditure';
    public $incrementing = true; // Auto-increment
    protected $keyType = 'int'; // Tipe data primary key
    protected $fillable = [
        'date',
        'description',
        'nominal'
    ];

    /**
     * Get all of the cashiers for the Expenditure
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
