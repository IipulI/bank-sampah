<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $guarded = ['kode_transaksi'];
    protected $primaryKey = 'kode_transaksi';
    protected $keyType = 'string';
    public $incrementing = false;

    public function masyarakat() : BelongsTo {
        return $this->belongsTo(Masyarakat::class, 'no_nik', 'no_nik');
    }

    public function staff() : BelongsTo {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
    }

    public function TipeSampah() : BelongsToMany {
        return $this->belongsToMany(Sampah::class, 'transaksi_sampah', 'kode_transaksi', 'kode_sampah')->withPivot('timbangan', 'harga');
    }
}
