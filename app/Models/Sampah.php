<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sampah extends Model
{
    use HasFactory;

    protected $table = 'tipe_sampah';

    protected $guarded = ['kode_sampah'];
    protected $primaryKey = 'kode_sampah';
    protected $keyType = 'string';
    public $incrementing = false;

    public function transaksiSampah() : BelongsToMany {
        return $this->belongsToMany(Transaksi::class, 'transaksi_sampah', 'kode_sampah', 'kode_transaksi')->using(TransaksiSampah::class);
    }
}
