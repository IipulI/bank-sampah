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

    protected $guarded = ['transaksi_id'];
    protected $primaryKey = 'transaksi_id';

    public function masyarakat() : BelongsTo {
        return $this->belongsTo(Masyarakat::class, 'no_nik', 'no_nik');
    }

    public function staff() : BelongsTo {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
    }

    public function TipeSampah() : BelongsToMany {
        return $this->belongsToMany(Sampah::class, 'transaksi_sampah', 'transaksi_id', 'tipe_sampah_id')->withPivot('timbangan', 'harga');
    }
}
