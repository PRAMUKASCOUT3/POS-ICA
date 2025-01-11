<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'code',
        'name',
        'email',
        'password',
        'isAdmin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function transaction():HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generate kode barang otomatis
            $model->code = User::generateKodeUser();
        });
    }

    public static function generateKodeUser()
    {
        // Ambil kode barang terakhir dari database dan extract nomor
        $lastKode = User::max('code');
        $lastNumber = $lastKode ? intval(substr($lastKode, 2)) : 0; // Ambil angka setelah 'BR'

        // Tambahkan 1 ke nomor terakhir
        $newNumber = $lastNumber + 1;

        // Format angka baru menjadi 4 digit, misalnya '0001'
        $newKode = 'US' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        return $newKode;
    }
}
