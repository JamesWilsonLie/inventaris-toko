<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunItem extends Model
{
    use HasFactory;

    protected $table = 'akun_item';
    protected $fillable = [
        'akun_id',
        'item_id',
        'jumlah',
        'harga_jual',
        'note',
    ];

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
