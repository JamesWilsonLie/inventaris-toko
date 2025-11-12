<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    protected $table = 'akun';
    protected $fillable = [
        'game_id',
        'nama',
        'deskripsi',
        'note',
        'jenis',
        'harga_beli',
        'harga_jual',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'akun_item', 'akun_id', 'item_id')
                    ->withPivot(['jumlah', 'harga_jual', 'note'])
                    ->withTimestamps();
    }

    public function totalNilaiItem()
    {
        return $this->items->sum(function ($item) {
            return $item->harga_pasar * ($item->pivot->jumlah ?? 1);
        });
    }

    public function estimasiKeuntungan()
    {
        if ($this->jenis !== 'reseller' || $this->harga_beli === null || $this->harga_jual === null) {
            return 0;
        }
        return $this->harga_jual - $this->harga_beli;
    }
}
