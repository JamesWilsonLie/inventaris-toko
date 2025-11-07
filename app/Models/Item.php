<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'item';
    protected $fillable = [
        'nama',
        'harga_pasar',
        'note'
    ];

    public function akun()
    {
        return $this->belongsToMany(Akun::class, 'akun_item', 'item_id', 'akun_id')
                    ->withPivot(['jumlah', 'harga_jual', 'note'])
                    ->withTimestamps();
    }
}
