<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sampah extends Model
{
    use HasFactory;

    protected $table = 'tipe_sampah';

    protected $guarded = ['transaksi_id'];
    protected $primaryKey = 'tipe_sampah_id';

    public function transaksiSampah() : BelongsToMany {
        return $this->belongsToMany(Transaksi::class, 'transaksi_sampah', 'tipe_sampah_id', 'transaksi_id')->using(TransaksiSampah::class);
    }
}
