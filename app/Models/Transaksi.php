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

    protected $guarded = ['id'];

    public function anggota() : BelongsTo {
        return $this->belongsTo(Anggota::class);
    }

    public function staff() : BelongsTo {
        return $this->belongsTo(Staff::class);
    }

    public function TipeSampah() : BelongsToMany {
        return $this->belongsToMany(Sampah::class, 'transaksi_sampah', 'transaksi_id', 'tipe_sampah_id')->withPivot('timbangan', 'harga');
    }
}
